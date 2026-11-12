<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acknowledgment: Submission to Governor Secretariat</title>
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
            line-height: 1.6;
            color: #374151;
            margin-bottom: 24px;
        }
        .reference-card {
            background: linear-gradient(135deg, #142820 0%, #1c382e 100%);
            border-radius: 8px;
            padding: 18px 20px;
            text-align: center;
            margin-bottom: 26px;
            color: #ffffff;
            border-left: 5px solid #FECB00;
        }
        .reference-card .ref-label {
            font-size: 11.5px;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: #e5e7eb;
            margin-bottom: 6px;
        }
        .reference-card .ref-number {
            font-size: 22px;
            font-family: 'Courier New', Courier, monospace;
            font-weight: 700;
            color: #FECB00;
            letter-spacing: 1px;
        }
        .reference-card .ref-note {
            font-size: 12px;
            color: #d1d5db;
            margin-top: 6px;
        }
        .section-title {
            font-size: 14px;
            font-weight: 700;
            color: #142820;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 22px 0 12px;
            padding-bottom: 6px;
            border-bottom: 2px solid #e5e7eb;
        }
        .details-table {
            width: 100%;
            margin-bottom: 20px;
        }
        .details-table td {
            padding: 9px 12px;
            font-size: 13.5px;
            border-bottom: 1px solid #f3f4f6;
            vertical-align: top;
        }
        .details-table td.label-col {
            width: 32%;
            font-weight: 600;
            color: #4b5563;
            background-color: #f9fafb;
        }
        .details-table td.value-col {
            color: #111827;
        }
        .message-box {
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            border-left: 4px solid #142820;
            border-radius: 6px;
            padding: 14px 16px;
            font-size: 13.5px;
            line-height: 1.6;
            color: #374151;
            white-space: pre-wrap;
            margin-bottom: 24px;
        }
        .info-notice {
            background-color: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 6px;
            padding: 12px 16px;
            font-size: 13px;
            color: #1e40af;
            line-height: 1.5;
            margin-bottom: 24px;
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
                <p class="sub-title">Khyber Pakhtunkhwa • Talk to the Governor</p>
            </div>

            <!-- Body -->
            <div class="email-body">
                <div class="greeting">Dear {{ $submission->name }},</div>

                <p class="intro-text">
                    Thank you for reaching out directly to the Office of the Governor, Khyber Pakhtunkhwa.
                    Your submission has been officially received by the Governor's Secretariat and assigned the following tracking reference number:
                </p>

                <!-- Tracking Box -->
                <div class="reference-card">
                    <div class="ref-label">Your Tracking Reference Number</div>
                    <div class="ref-number">{{ $submission->reference_number }}</div>
                    <div class="ref-note">Please quote this reference number in any future follow-up or correspondence.</div>
                </div>

                <!-- Submission Details -->
                <div class="section-title">Summary of Your Submission</div>
                <table class="details-table">
                    <tr>
                        <td class="label-col">Full Name:</td>
                        <td class="value-col">{{ $submission->name }}</td>
                    </tr>
                    <tr>
                        <td class="label-col">Email Address:</td>
                        <td class="value-col">{{ $submission->email }}</td>
                    </tr>
                    <tr>
                        <td class="label-col">Mobile Number:</td>
                        <td class="value-col">{{ $submission->mobile_number }}</td>
                    </tr>
                    @if ($submission->cnic)
                    <tr>
                        <td class="label-col">CNIC:</td>
                        <td class="value-col">{{ $submission->cnic }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td class="label-col">District:</td>
                        <td class="value-col">{{ $submission->district }}</td>
                    </tr>
                    <tr>
                        <td class="label-col">Category:</td>
                        <td class="value-col">{{ $submission->category }}</td>
                    </tr>
                    <tr>
                        <td class="label-col">Subject:</td>
                        <td class="value-col"><strong>{{ $submission->subject }}</strong></td>
                    </tr>
                    <tr>
                        <td class="label-col">Date & Time:</td>
                        <td class="value-col">{{ $submission->created_at ? $submission->created_at->format('d F Y, h:i A') : now()->format('d F Y, h:i A') }}</td>
                    </tr>
                    <tr>
                        <td class="label-col">Attachments:</td>
                        <td class="value-col">
                            @php
                                $attachmentsList = [];
                                if ($submission->document) {
                                    $attachmentsList[] = '1 PDF Document';
                                }
                                $imgCount = !empty($submission->images_list) ? count($submission->images_list) : 0;
                                if ($imgCount > 0) {
                                    $attachmentsList[] = $imgCount . ' Photo(s)';
                                }
                            @endphp
                            {{ !empty($attachmentsList) ? implode(', ', $attachmentsList) : 'None' }}
                        </td>
                    </tr>
                </table>

                <div class="section-title">Your Submitted Message</div>
                <div class="message-box">{{ $submission->message }}</div>

                <div class="info-notice">
                    <strong>Next Steps:</strong> Every submission is cataloged and reviewed by the Governor's Secretariat. If further information or an official response is required, the Secretariat will contact you via your provided email address or phone number.
                </div>
            </div>

            <!-- Footer -->
            <div class="email-footer">
                <strong>Governor's Secretariat, Khyber Pakhtunkhwa</strong>
                Governor House Peshawar, Aga Khan Road, Peshawar Cantt, Pakistan<br>
                Official Inquiries: <a href="mailto:info@governorhouse.kp.gov.pk" style="color:#142820; text-decoration:none;">info@governorhouse.kp.gov.pk</a> | 
                <a href="mailto:secretariat@governorhouse.kp.gov.pk" style="color:#142820; text-decoration:none;">secretariat@governorhouse.kp.gov.pk</a><br>
                <span style="font-size: 11px; color: #9ca3af; margin-top: 8px; display: inline-block;">This is an automated acknowledgment email from the Governor House KP Official Portal.</span>
            </div>
        </div>
    </div>
</body>
</html>

