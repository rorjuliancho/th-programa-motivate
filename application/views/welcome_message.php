<div class="container">
	<div class="row pt-5 pb-4">
		<div class="visibleMobile text-center logo-responsive">
			<img class="logo-responsive" src="<?= base_url() ?>public/images/logo.png" alt="Logo_Motivate">
		</div>
		<div class="col-lg-7 login-left">
			<div class="row p-5">
				<h1>Sabías que...</h1>
				<span>¿Participando y cumpliendo con las actividades del programa <strong>MOTÍVATE</strong> podrías obtener un día de trabajo libre?</span>
				<h2 class="p-4">¡Actúa hoy y Disfruta!</h2>
				<p>Tu participación fortalece nuestro equipo y tu seguridad</p>
			</div>
		</div>
		<div class="col-lg-5 pt-5 mb-4 login-right text-center d-flex flex-column justify-content-between">
			<div class="visibleDesktop">
				<img src="<?= base_url() ?>public/images/logo.png" alt="Logo_Motivate">
			</div>
			<h1>Ingresar</h1>
			<p>Ingresa tu número de documento y valida tu puntuación en Motívate.</p>
			<form action="<?= base_url() ?>Welcome/login" method="POST">
				<input type="text" class="form-control mb-4" name="cedula" placeholder="Ej. 10210215515">
				<button class="btn btn-lg btn-block">Ingresar</button>
			</form>
			<img src="<?= base_url() ?>public/images/empresas.png" alt="logo_empresas">
		</div>
	</div>
</div>