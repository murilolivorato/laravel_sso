<h2 style="list-style: none; vertical-align: middle; margin-top: 0px; margin-bottom: 0.5em; line-height: 1em; font-size: 2em; font-family:  Helvetica, Arial, sans-serif; text-align: center; color: rgb(51, 51, 51); ">Redefinição de Senha</h2>
<p style="color: rgb(51, 51, 51); font-family: Helvetica, Arial, sans-serif; text-align: center;padding-bottom:10px;" >Olá {{ $user->name }}, Para cadastrar sua nova senha, clique no link abaixo  , este link de acesso é válido por 24hs .</p>

<p  style="text-align: center;" ><a href="{{ $recover_password_link }}" target="_blank" style="vertical-align: middle;font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; border-radius: 3px; -webkit-border-radius: 3px; -moz-border-radius: 3px; background-color: #a30000; border-top: 12px solid #a30000; border-bottom: 12px solid #a30000; border-right: 18px solid #a30000; border-left: 18px solid #a30000; display: inline-block;" align="center" >CRIAR NOVA SENHA</a></p>

<p style="color: rgb(51, 51, 51); font-family: Helvetica, Arial, sans-serif; text-align: center;padding-top:20px;" >Se você estiver tendo problemas em clicar no botão acima , copie e cole o endereço abaixo no seu navegador e prossiga com o cadastro da nova senha. </p>
<p style="color: rgb(11, 87, 122); font-family: Helvetica, Arial, sans-serif; text-align: center;"  ><a href="{{ $recover_password_link }}" target="_blank" > {{ $recover_password_link  }} </a></p>


<p style="color: rgb(51, 51, 51); font-family: Helvetica, Arial, sans-serif; text-align: center;line-height:26px;padding-top:20px;" >Caso não tenha solicitado a troca da senha, é só ignorar este e-mail e continuar usando a sua senha atual. <br /><br />Atenciosamente <br />Equipe de Atendimento JHE <br />{{ config('app.url') }} </p>
