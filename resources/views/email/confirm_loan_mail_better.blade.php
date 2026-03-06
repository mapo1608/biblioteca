<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Notifica Prestito Libro</title>
    <style>
        /* CSS Reset e Base Styles */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        /* Garantisce che tutte le tabelle siano larghe al 100% per default */
        table {
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        /* MEDIA QUERIES per la responsività */
        @media only screen and (max-width: 600px) {
            .main-table {
                width: 100% !important;
            }
            .content-area {
                padding: 20px !important;
            }
            .header-cell {
                padding: 15px 20px !important;
                font-size: 20px !important;
            }
            /* Rende le celle a larghezza fissa (come le etichette) fluidi su mobile */
            .detail-label {
                width: auto !important;
                display: block !important;
                margin-bottom: 5px;
            }
            /* Rimuove padding extra sui lati per sfruttare lo spazio */
            .padding-reset {
                padding-left: 0px !important;
                padding-right: 0px !important;
            }
        }
    </style>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333333; margin: 0; padding: 0; background-color: #f4f4f4;">

    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f4f4f4;">
        <tr>
            <td align="center" class="padding-reset" style="padding: 40px 0;">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="600" class="main-table" style="width: 600px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    <tr>
                        <td class="header-cell" style="padding: 20px 40px; background-color: #17a2b8; color: #ffffff; border-top-left-radius: 8px; border-top-right-radius: 8px; font-size: 24px;">
                            <h1 style="font-size: 24px; margin: 0;">Prestito del Libro Avviato</h1>
                        </td>
                    </tr>
                    <tr>
                        <td class="content-area" style="padding: 40px;">
                            <p style="margin-bottom: 20px;">Si comunica che è stato avviato dall'account del presente indirizzo email il prestito di un libro.</p>

                            <div style="background-color: #e9ecef; border-left: 5px solid #17a2b8; padding: 15px; margin-bottom: 25px; border-radius: 4px;">
                                <p style="font-weight: bold; margin-top: 0; margin-bottom: 10px; color: #17a2b8;">Dettagli del prestito:</p>
                                <ul style="list-style: none; padding: 0; margin: 0;">
                                    <li style="margin-bottom: 8px;">
                                        <strong class="detail-label" style="display: inline-block; width: 160px; color: #333333;">Libro:</strong> {{ $book }}
                                    </li>
                                    <li style="margin-bottom: 8px;">
                                        <strong class="detail-label" style="display: inline-block; width: 160px; color: #333333;">Data inizio prestito:</strong> {{ $start_date }}
                                    </li>
                                    <li style="margin-bottom: 8px;">
                                        <strong class="detail-label" style="display: inline-block; width: 160px; color: #333333;">Data fine prestito:</strong> {{ $expiration_date }}
                                    </li>
                                </ul>
                            </div>

                            <p style="margin-bottom: 30px; padding: 10px; border: 1px dashed #dc3545; background-color: #f8d7da; color: #721c24; border-radius: 4px;">
                                **Si ricorda che il ritardo nella riconsegna del prestito comporta la sospensione dell'account a successivi prestiti.**
                            </p>

                            <p>Cordiali saluti,</p>
                            <p style="margin-top: 5px;">Il Tuo Servizio</p>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding: 20px 40px; border-top: 1px solid #eeeeee;">
                            <p style="font-size: 12px; color: #999999; margin: 0;">
                                Questa è una notifica automatica. Si prega di non rispondere a questo indirizzo email.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>
</html>