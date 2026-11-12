<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acknowledgment: Query to Governor House Khyber Pakhtunkhwa</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f3f4f6;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            color: #1f2937;
            -webkit-font-smoothing: antialiased;
        }
        table {
            border-collapse: collapse;
        }
        .email-wrapper {
            width: 100%;
            background-color: #f3f4f6;
            padding: 30px 15px;
        }
        .email-container {
            max-width: 620px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e7eb;
        }
        .email-header {
            background-color: #142820;
            padding: 28px 30px 22px;
            text-align: center;
            border-bottom: 4px solid #FECB00;
        }
        .email-header h1 {
            color: #ffffff;
            font-size: 20px;
            margin: 0 0 6px 0;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        .email-header .sub-title {
            color: #FECB00;
            font-size: 13px;
            margin: 0;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .email-body {
            padding: 32px 30px;
        }
        .greeting {
            font-size: 16px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 14px;
        }
        .intro-text {
            font-size: 14.5px;
            line-height: 1.65;
            color: #374151;
            margin-bottom: 24px;
        }
        .section-title {
            font-size: 14px;
            font-weight: 700;
            color: #142820;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 24px 0 12px 0;
            padding-bottom: 6px;
            border-bottom: 2px solid #e5e7eb;
        }
        .details-table {
            width: 100%;
            margin-bottom: 22px;
        }
        .details-table td {
            padding: 10px 12px;
            font-size: 14px;
            line-height: 1.5;
            vertical-align: top;
            border-bottom: 1px solid #f3f4f6;
        }
        .details-table .label-col {
            width: 32%;
            color: #6b7280;
            font-weight: 600;
        }
        .details-table .value-col {
            color: #111827;
        }
        .message-box {
            background-color: #f9fafb;
            border-left: 4px solid #142820;
            padding: 16px;
            font-size: 14px;
            line-height: 1.6;
            color: #374151;
            border-radius: 0 6px 6px 0;
            white-space: pre-wrap;
            word-break: break-word;
            margin-bottom: 24px;
        }
        .automated-note {
            background-color: #fefce8;
            border: 1px solid #fef08a;
            color: #854d0e;
            padding: 12px 16px;
            border-radius: 6px;
            font-size: 13px;
            line-height: 1.5;
            margin-top: 20px;
            text-align: center;
        }
        .email-footer {
            background-color: #f9fafb;
            border-top: 1px solid #e5e7eb;
            padding: 22px 30px;
            text-align: center;
            font-size: 12px;
            color: #6b7280;
            line-height: 1.6;
        }
        .email-footer strong {
            color: #142820;
            display: block;
            margin-bottom: 4px;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-container">
            <!-- Header -->
            <div class="email-header">
                <h1>Office of the Governor</h1>
                <p class="sub-title">Khyber Pakhtunkhwa • Contact Secretariat</p>
            </div>

            <!-- Body -->
            <div class="email-body">
                <p class="intro-text">
                    Dear <strong>{{ $contact->name }}</strong>, thank you for contacting Governor House Khyber Pakhtunkhwa. Your query has been received and our team will get back to you shortly. This is an automated message, so please do not reply.
                </p>

                <!-- Submission Details -->
                <div class="section-title">Summary of Your Query</div>
                <table class="details-table">
                    <tr>
                        <td class="label-col">Full Name:</td>
                        <td class="value-col"><strong>{{ $contact->name }}</strong></td>
                    </tr>
                    <tr>
                        <td class="label-col">Email Address:</td>
                        <td class="value-col">{{ $contact->email }}</td>
                    </tr>
                    <tr>
                        <td class="label-col">Subject:</td>
                        <td class="value-col"><strong>{{ $contact->subject }}</strong></td>
                    </tr>
                    <tr>
                        <td class="label-col">Date & Time:</td>
                        <td class="value-col">{{ $contact->created_at ? $contact->created_at->format('d F Y, h:i A') : now()->format('d F Y, h:i A') }}</td>
                    </tr>
                </table>

                <div class="section-title">Message Content</div>
                <div class="message-box">{{ $contact->description }}</div>

                <div class="automated-note">
                    This is an automated acknowledgment message. Please do not reply directly to this email.
                </div>
            </div>

            <!-- Footer -->
            <div class="email-footer">
                <strong>Governor's Secretariat, Khyber Pakhtunkhwa</strong>
                Governor House Peshawar, Aga Khan Road, Peshawar Cantt, Pakistan<br>
                Official Website: <a href="{{ url('/') }}" style="color: #142820; text-decoration: underline;">governor.kp.gov.pk</a>
            </div>
        </div>
    </div>
</body>
</html>
