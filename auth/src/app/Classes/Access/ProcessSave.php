<?php

namespace App\Classes\Access;

use App\Exceptions\StoreDataException;
use App\Models\UserAdmin;
use App\Models\UserAdminAccessArea;
use App\Models\UserAdminInfo;
use App\Models\UserAdminProfileImage;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
/**
 * ProcessSave
 */
class ProcessSave
{
    use ApiResponse;
    /**
     * @var
     */
    protected $request;

    /**
     * @var
     */
    protected $result;

    /**
     * @param Request $request
     * @param UserAdminAccessArea $acessArea
     * @return \Illuminate\Http\JsonResponse
     */
    public static function process(Request $request , UserAdmin $userAdmin){
        try {
            return (new static)->handle($request, $userAdmin);
        }
        catch (\Exeption $exeption) {
            throw $exeption->getMessage();
        }

    }

    /**
     * @param $request
     * @param $acessArea
     * @return \Illuminate\Http\JsonResponse
     */
    private function handle($request , UserAdmin $userAdmin){
        return   $this->setRequest($request)->save($userAdmin);
    }

    /**
     * @param $request
     * @return $this
     */
    private function setRequest(Request $request){
        $this->request = $request;
        return $this;
    }

    /**
     * @param $acessArea
     * @return $this
     */
    private function save(UserAdmin $userAdmin)
    {
        return DB::transaction(function () use ($userAdmin) {
            $action        = ! $userAdmin->exists  ? "create" : "update";
            $userAdmin->status = $this->request['status'];
            $userAdmin->email = $this->request['email'];
            $userAdmin->password = Hash::make($this->request['password']);
            $userAdmin->folder = null;
            $userAdmin->save();

            $userAdmin->update(['folder' => Hashids::connection('user_folder')->encode($userAdmin->id)]);

            UserAdminInfo::updateOrCreate(
                ['user_id' =>  $userAdmin->id],
                [
                    'name'      => $this->request->admin_info['name'],
                    'cpf'       => $this->request->admin_info['cpf'],
                    'phone'     => $this->request->admin_info['phone'],
                    'last_name' => $this->request->admin_info['last_name']
                ]
            );

            $userAdmin->roles()->sync(
                [0 => $this->request['role_id'] ]
            );

            $userAdmin->AcessAreas()->sync(
                [0 => $this->request['area_id'] ]
            );
            UserAdminProfileImage::updateOrCreate(
                ['user_id' =>  $userAdmin->id],
                [
                    'image'   => $this->uploadImage($this->request->file('image_profile')),
                    //'user_ip' => ip2long($_SERVER['REMOTE_ADDR'])
                    'user_ip' => 123
                ]
            );

            return $this->successResponse(`User {$action} Successfully`, $action == "create" ? Response::HTTP_CREATED : Response::HTTP_OK );

        });
    }


    protected function uploadImage($anexo)
    {
        // STORE
        try {
            $fileName = $this->createImageName($anexo);
            Storage::disk('public')->put("images/" . $fileName, 'public');
            return $fileName;
            //return ["nome" => $fileName, "tipo_mime" => $anexo->getClientOriginalExtension(), "tamanho" => $anexo->getSize(), "nome_arquivo" => $anexo->getClientOriginalName()];
        } catch(\Exception $e) {
            return null;
        }
    }

    public function createImageName($fileName)
    {
        $image = sha1(
            time() . $fileName->getClientOriginalName()
        );
        $extension = $fileName->getClientOriginalExtension();
        return $image . "." . $extension;
    }
}
