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
        margin: 110px;
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
          <h2>Edit Profile Page</h2>
        </div>
        <?= form_open_multipart(base_url() . 'index.php/AccountCtl/editingProfile'); ?>
        <label style="padding-top:13px">&nbsp;Email
        </label>
        <input style="border:none; background: transparent" class="form-contenta" type="text" id="email" name="email" value="<?= $user['email']; ?>" readonly>
        <div class="form-bordera"></div>
        <label style="padding-top:13px">&nbsp;Username
        </label>
        <input style="border:none; background: transparent" class="form-contenta" type="text" type="text" id="username" name="username" value="<?= $user['username']; ?>" readonly>
        <div class="form-bordera"></div>
        <label style="padding-top:13px">&nbsp;Nama
        </label>
        <input style="border:none; background: transparent" class="form-contenta" type="text" id="nama" name="nama" value="<?= $user['nama']; ?>">
        <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
        <div class="form-bordera"></div>
        <label style="padding-top:13px">&nbsp;Foto</label>
        <div class="col-sm-10">
          <div class="row">
            <div class="col-sm-3" align="center">
              <img src="<?= base_url('photos/') . $user['photo']; ?>" class="card-img" width=150 height=200>
            </div>
            <div class="col-sm-9">
              <div class="custom-file" align="center">
                <input type="file" class="custom-file-input" id="photo" name="photo">
                <label class="custom-file-label" for="photo">Pilih berkas</label>
              </div>
            </div>
          </div>
        </div>
      </div>
      <input id="submit-btn" type="submit" name="submit" value="SIMPAN" />
      <?= form_close(); ?>
    </div>
    </div>
</section>
</body>