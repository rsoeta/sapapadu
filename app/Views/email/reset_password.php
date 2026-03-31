<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Reset Password - SAPAPADU</title>
</head>

<body style="font-family: Arial, sans-serif; background:#f5f7fa; padding:20px;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table width="600" style="background:white; border-radius:8px; overflow:hidden;">
                    <tr>
                        <td style="background:#007bff; padding:20px; color:white; text-align:center;">
                            <h2>SAPAPADU — Pasirlangu</h2>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:30px;">
                            <p>Halo <strong><?= $name ?></strong>,</p>

                            <p>Kami menerima permintaan untuk mereset password akun Anda. Silakan klik tombol di bawah ini:</p>

                            <p style="text-align:center; margin:30px 0;">
                                <a href="<?= $url ?>"
                                    style="background:#28a745; color:white; padding:12px 20px; 
                                          text-decoration:none; border-radius:5px;
                                          font-weight:bold; display:inline-block;">
                                    Reset Password
                                </a>
                            </p>

                            <p>Link ini berlaku selama <strong>1 jam</strong>.</p>

                            <p>Jika Anda tidak meminta reset password, abaikan email ini.</p>

                            <br>
                            <p>Hormat kami,<br><strong>Tim SAPAPADU</strong></p>
                        </td>
                    </tr>

                    <tr>
                        <td style="background:#eeeeee; padding:15px; text-align:center; font-size:12px;">
                            © <?= date('Y') ?> SAPAPADU — Kecamatan Pakenjeng
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>