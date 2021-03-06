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
                width: 329px;
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
                margin: 0 auto;
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
                background: #fbfbfb;
                border: none;
                outline: none;
                padding-top: 14px;
            }

            .underline-title {
                background: -webkit-linear-gradient(right, #a6f77b, #2ec06f);
                height: 2px;
                margin: -1.1rem auto 0 auto;
                width: 89px;
            }
        </style>
    </head>

    <body>
        <div id="carda">
            <div id="card-contenta">
                <div id="card-title">
                    <h2>LOGIN</h2>
                    <div class="underline-title"></div>
                </div>
                <p><?php if (strlen($msg) > 0) echo $msg; ?></p>
                <form class="forma" action="<?php echo base_url() . 'index.php/accountCtl/checkingLogin'; ?>" method="post">
                    <label for="user-username" style="padding-top:13px" data-validate="masukan username">&nbsp;Username
                    </label>
                    <input style="border:none; background: transparent" class="form-contenta" type="text" id="username" name="username" data-placeholder="Username" required />
                    <div class="form-bordera"></div>
                    <label for="user-password" style="padding-top:22px" data-validate="masukan password">&nbsp;Password
                    </label>
                    <input style="border:none; background: transparent" class=" form-contenta" type="password" id="katasandi" name="katasandi" data-placeholder="Password" required />
                    <div class="form-bordera"></div>
                    <input id="submit-btn" type="submit" name="submit" value="LOGIN" />
                    <a href="<?php echo base_url() . 'welcome/signup'; ?>" id="signup">Don't have account yet?</a>
                </form>
            </div>
        </div>
</section>
</body>