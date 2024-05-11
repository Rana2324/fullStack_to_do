<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>

<body>
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="border-collapse: collapse; border: 1px solid #ccc;">
                    <tr>
                        <td align="center" bgcolor="#f5f5f5" style="padding: 40px 0;">
                            <h2 style="margin: 0; color: #333;">Verify Your Email Address</h2>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" style="padding: 40px 30px;">
                            <p style="margin: 0; color: #666;">Thanks for signing up! Please click the button below to
                                verify your email address:</p>
                            <p style="margin: 30px 0;">
                                <a href="http://127.0.0.1:8000/api/verify?email={{ $email }}"
                                    style="background-color: #007bff; color: #ffffff; text-decoration: none; padding: 10px 20px; border-radius: 5px; display: inline-block;">Verify
                                    Email Address</a>
                            </p>
                            <p style="margin: 0; color: #666;">If you did not create an account, no further action is
                                required.</p>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" bgcolor="#f5f5f5" style="padding: 20px 0;">
                            <p style="margin: 0; color: #666;">Regards,<br>Your Website Team</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
