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
                width: 190px;
            }
        </style>
    </head>

    <body>
        <div id="carda">
            <div id="card-contenta">
                <div id="card-title">
                    <h2>Deduct Fund</h2>
                    <div class="underline-title"></div>
                    <p>
                        Please don't deduct fund more than your credits.
                        <p><?php if (strlen($msg) > 0) echo $msg; ?></p>
                    </p>
                </div>
                <form action="<?php echo base_url() . 'index.php/reviewerCtl/deductFunding'; ?>" method="post">
                    <label style="padding-top:13px">&nbsp;Username
                    </label>
                    <input style="border:none; background: transparent" class="form-contenta" type="text" id="username" name="username" value="<?= $username; ?>" readonly />
                    <div class="form-bordera"></div>
                    <label style="padding-top:13px">&nbsp;Your Account Number
                    </label>
                    <input style="border:none; background: transparent" class="form-contenta" type="text" id="no_rek" name="no_rek" value="<?= $saldo[0]['no_rek']; ?>" readonly />
                    <div class="form-bordera"></div>
                    <label style="padding-top:13px">&nbsp;Your Balance
                    </label>
                    <input style="border:none; background: transparent" class="form-contenta" type="text" id="saldo" name="saldo" value="<?= $saldo[0]['saldo']; ?>" readonly />
                    <div class="form-bordera"></div>
                    <label style="padding-top:22px">&nbsp;Deduct Fund Credits
                    </label>
                    <input style="border:none; background: transparent" class="form-contenta" type="text" id="potongansaldo" name="potongansaldo" required="required" />
                    <div class="form-bordera"></div>
                    <input id="submit-btn" type="submit" name="submit" value="Proses" />
                </form>
            </div>
        </div>
</section>
</body>