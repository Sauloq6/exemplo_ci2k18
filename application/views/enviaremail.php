<h2>Enviar e-mail</h2>
<form action="<?=base_url('Curso/email') ?>" method="post">
	Digite seu email: <input type="text" id="email"></input><br>
	Para quem deseja enviar um email? <input type="text" id="email1"></input><br>
	Digite a sua mensagem: <input type="text" id="msg"></input>
</form>
<button type="submit">Enviar</button>