<section id="maincontent">

    <head>
        <style>
            a {
                text-decoration: none;
            }

            body {
                background: -webkit-linear-gradient(bottom, #2dbd6e, #a6f77b);
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
                width: 450px;
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
                margin: 90px;
                margin-bottom: 40px;
                margin-top: 50px;
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
                background: transparent;
                border: none;
                outline: none;
                padding-top: 14px;
            }

            .underline-title {
                background: -webkit-linear-gradient(right, #a6f77b, #2ec06f);
                height: 2px;
                margin: -1.1rem auto 0 auto;
                width: 200px;
            }
        </style>
    </head>

    <body>
        <div id="carda">
            <div id="card-contenta">
                <div id="card-title">
                    <h2>Sign-Up Form</h2>
                    <div class="underline-title"></div>
                    <p>
                        Please fill in your account details! Field with <span style="color:red">*</span> is mandatory.
                        <?php if (strlen($msg) > 0) echo $msg; ?>
                    </p>
                </div>
                <form action="<?= base_url() . 'index.php/AccountCtl/creatingAccount'; ?>" method="post">
                    <label for="user-username" style="padding-top:13px">&nbsp;<span style="color:red">*</span>Nama
                    </label>
                    <input style="border:none; background: transparent" class="form-contenta" type="text" id="nama" name="nama" required />
                    <div class="form-bordera"></div>
                    <label style="padding-top:22px">&nbsp;<span style="color:red">*</span>Username
                    </label>
                    <input style="border:none; background: transparent" class=" form-contenta" type="text" id="username" name="username" required />
                    <div class="form-bordera"></div>
                    <label style="padding-top:22px">&nbsp;<span style="color:red">*</span>Password
                    </label>
                    <input style="border:none; background: transparent" class=" form-contenta" type="password" id="password" name="password" required />
                    <div class="form-bordera"></div>
                    <label style="padding-top:22px">&nbsp;<span style="color:red">*</span>Email
                    </label>
                    <input style="border:none; background: transparent" class=" form-contenta" type="text" id="email" name="email" required />
                    <div class="form-bordera"></div>
                    <label style="padding-top:22px">&nbsp;<span style="color:red">*</span>Role
                    </label>
                    <input type="checkbox" id="editor" name="roles[]" value="1" CHECKED />Editor<br />
                    <input type="checkbox" id="reviewer" name="roles[]" value="2" />Reviewer<br />
                    <label id="field" style="padding-top:13px;display:none">&nbsp;No. Rekening</label>
                    <input id="norek" name="no_rek" style="border:none; background: transparent;display:none" class="form-contenta" />
                    <div id="line" class="form-bordera" style="display: none"></div>
                    <label id="field2" style="padding-top:13px;display:none">&nbsp;Kompetensi</label>
                    <textarea id="kompetensi" name="kompetensi" style="display: none; border:none; background: transparent;" class="form-contenta" type="text" /></textarea>
                    <div id="line2" class="form-bordera" style="display: none"></div>
                    <input id="submit-btn" type="submit" name="submit" value="SIGN UP" />
                </form>
            </div>
        </div>
</section>
</body>
<script type="text/javascript">
    document.getElementById("reviewer").addEventListener("click", function() {
        var x = document.getElementById("reviewer").checked;
        if (x == true) {
            document.getElementById("norek").style.display = '';
            document.getElementById("field").style.display = '';
            document.getElementById("line").style.display = '';
            document.getElementById("line2").style.display = '';
            document.getElementById("field2").style.display = '';
            document.getElementById("kompetensi").style.display = '';
        } else {
            document.getElementById("norek").style.display = 'none';
            document.getElementById("line").style.display = 'none';
            document.getElementById("field").style.display = 'none';
            document.getElementById("line2").style.display = 'none';
            document.getElementById("field2").style.display = 'none';
            document.getElementById("kompetensi").style.display = 'none';
        }
    });
</script>