
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Please verify your email address</h2>

        <div>
            Thanks for creating an account at CloudSync. Please follow the link below to verify your email
            address {{ URL::to('register/verify/' . $conf_code) }}.<br/>

            If you have problems, please paste the above URL into your web browser.

        </div>

    </body>
</html>