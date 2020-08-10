<section id="maincontent">

	<head>
		<style>
			a {
				text-decoration: none;
			}

			body {
				background: -webkit-linear-gradient(bottom, #808080);
				background-repeat: no-repeat;
			}

			label {
				font-family: "Raleway", sans-serif;
				font-size: 11pt;
			}

			#carda {
				background: #fbfbfb;
				border-radius: 8px;
				box-shadow: 1px 2px 8px rgba(0, 0, 0, 0.65);
				height: auto;
				margin: 6rem auto 8.1rem auto;
				width: 400px;
			}

			#card-contenta {
				padding: 12px 44px;
			}

			#card-title {
				font-family: "Raleway Thin", sans-serif;
				letter-spacing: 4px;
				padding-bottom: 23px;
				padding-top: 13px;
				text-align: center;
			}

			#signup {
				color: #2dbd6e;
				font-family: "Raleway", sans-serif;
				font-size: 10pt;
				margin-top: 16px;
				text-align: center;
			}

			#submit-btn {
				background: -webkit-linear-gradient(right, #a6f77b, #2dbd6e);
				border: none;
				border-radius: 21px;
				box-shadow: 0px 1px 8px #24c64f;
				cursor: pointer;
				color: white;
				font-family: "Raleway SemiBold", sans-serif;
				height: 42.3px;
				margin: 70px;
				margin-top: 25px;
				transition: 0.25s;
				width: 153px;
			}

			#submit-btn:hover {
				box-shadow: 0px 1px 18px #24c64f;
			}

			.forma {
				align-items: left;
				display: flex;
				flex-direction: column;
			}

			.form-bordera {
				background: -webkit-linear-gradient(right, #a6f77b, #2ec06f);
				height: 1px;
				width: 100%;
			}

			.form-contenta {
				background: #fbfbfb;
				border: none;
				outline: none;
				padding-top: 14px;
			}

			.underline-title {
				background: -webkit-linear-gradient(right, #a6f77b, #2ec06f);
				height: 2px;
				margin: -1.1rem auto 0 auto;
				width: auto;
			}
		</style>
	</head>

	<body>
		<div id="carda">
			<div id="card-contenta">
				<div id="card-title">
					<h2>Select Potential Reviewer</h2>
					<p>
						<div class="alert alert-success" role="alert">A new task has been added succesfully.</div>
					</p>
				</div>
				<form action="<?php echo base_url() . 'index.php/editorCtl/addingPotential'; ?>" method="post">
					<label style="padding-top:13px">&nbsp;Id Task
					</label>
					<input style="border:none; background: transparent" class="form-contenta" type="text" id="id_task" name="id_task" value="<?php echo $task['id_task']; ?>" readonly />
					<div class="form-bordera"></div>
					<label style="padding-top:13px">&nbsp;Judul
					</label>
					<input style="border:none; background: transparent" class="form-contenta" type="text" id="judul" name="judul" value="<?php echo $task['judul']; ?>" readonly />
					<div class="form-bordera"></div>
					<label style="padding-top:13px">&nbsp;Kata Kunci
					</label>
					<input style="border:none; background: transparent" class="form-contenta" type="text" id="keywords" name="keywords" value="<?php echo $task['keywords']; ?>" readonly />
					<div class="form-bordera"></div>
					<label style="padding-top:22px">&nbsp;Reviewer
					</label>
					<select style="border:none; background: transparent" class="form-contenta" id="reviewer" name="reviewer" width="100">
						<?php foreach ($reviewers as $dd) { ?>
							<option value="<?php echo $dd['id_reviewer']; ?>"><?php echo $dd['nama']; ?> </option>
						<?php } ?>
					</select>
					<input id="submit-btn" type="submit" name="submit" value="SIMPAN" />
				</form>
			</div>
		</div>
</section>
</body>