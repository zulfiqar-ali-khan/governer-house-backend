<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Us Query: {{ $contact->subject }}</title>
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
            max-width: 650px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e7eb;
        }
        .email-header {
            background-color: #0f2b22;
            padding: 26px 30px 22px;
            text-align: center;
            border-bottom: 4px solid #FECB00;
        }
        .email-header .badge {
            display: inline-block;
            background-color: #FECB00;
            color: #0f2b22;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 4px 10px;
            border-radius: 12px;
            margin-bottom: 10px;
        }
        .email-header h1 {
            color: #ffffff;
            font-size: 20px;
            margin: 0 0 6px 0;
            font-weight: 700;
            letter-spacing: 0.3px;
        }
        .email-header .sub-title {
            color: rgba(255, 255, 255, 0.85);
            font-size: 12.5px;
            margin: 0;
            font-weight: 500;
        }
        .email-body {
            padding: 30px;
        }
        .summary-bar {
            background-color: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 8px;
            padding: 14px 18px;
            margin-bottom: 24px;
        }
        .summary-bar table {
            width: 100%;
        }
        .summary-bar td {
            font-size: 13.5px;
            color: #166534;
            padding: 3px 0;
        }
        .section-title {
            font-size: 13.5px;
            font-weight: 700;
            color: #0f2b22;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 22px 0 10px 0;
            padding-bottom: 6px;
            border-bottom: 2px solid #e5e7eb;
        }
        .details-table {
            width: 100%;
            margin-bottom: 22px;
        }
        .details-table td {
            padding: 9px 12px;
            font-size: 13.5px;
            line-height: 1.5;
            vertical-align: top;
            border-bottom: 1px solid #f3f4f6;
        }
        .details-table .label-col {
            width: 28%;
            color: #6b7280;
            font-weight: 600;
        }
        .details-table .value-col {
            color: #111827;
        }
        .message-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-left: 4px solid #0f2b22;
            padding: 16px 18px;
            font-size: 14px;
            line-height: 1.65;
            color: #1e293b;
            border-radius: 0 6px 6px 0;
            white-space: pre-wrap;
            word-break: break-word;
            margin-bottom: 24px;
        }
        .action-banner {
            background-color: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 8px;
            padding: 16px 20px;
            margin-top: 24px;
            text-align: center;
        }
        .action-banner p {
            margin: 0 0 12px 0;
            font-size: 13.5px;
            color: #1e40af;
            line-height: 1.5;
        }
        .action-btn {
            display: inline-block;
            background-color: #0f2b22;
            color: #ffffff !important;
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 600;
            padding: 10px 22px;
            border-radius: 6px;
            letter-spacing: 0.3px;
        }
        .email-footer {
            background-color: #f8fafc;
            border-top: 1px solid #e2e8f0;
            padding: 20px 30px;
            text-align: center;
            font-size: 12px;
            color: #64748b;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-container">
            <!-- Header -->
            <div class="email-header">
                <span class="badge">Governor Secretariat Alert</span>
                <h1>New Contact Us Query Received</h1>
                <p class="sub-title">Portal: Contact Us • Governor House Peshawar</p>
            </div>

            <!-- Body -->
            <div class="email-body">
                <p style="font-size: 14.5px; line-height: 1.65; color: #374151; margin: 0 0 22px 0;">
                    Dear Team, a new query has been received through the Contact Us form from <strong>{{ $contact->name }}</strong> (<strong>{{ $contact->email }}</strong>) regarding <em>{{ $contact->subject }}</em>. Please review it and respond to the sender at the earliest. Full details are available in the admin panel at <a href="{{ url('/contact-us') }}" style="color: #047857; text-decoration: underline; font-weight: 600;">{{ url('/contact-us') }}</a>.
                </p>

                <!-- Summary bar -->
                <div class="summary-bar">
                    <table>
                        <tr>
                            <td><strong>Sender:</strong> {{ $contact->name }}</td>
                            <td align="right"><strong>Date:</strong> {{ $contact->created_at ? $contact->created_at->format('d M, Y - h:i A') : now()->format('d M, Y - h:i A') }}</td>
                        </tr>
                        <tr>
                            <td colspan="2"><strong>Subject:</strong> {{ $contact->subject }}</td>
                        </tr>
                    </table>
                </div>

                <!-- Sender Information -->
                <div class="section-title">Sender Information</div>
                <table class="details-table">
                    <tr>
                        <td class="label-col">Full Name:</td>
                        <td class="value-col"><strong>{{ $contact->name }}</strong></td>
                    </tr>
                    <tr>
                        <td class="label-col">Email Address:</td>
                        <td class="value-col"><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></td>
                    </tr>
                    <tr>
                        <td class="label-col">Subject:</td>
                        <td class="value-col"><strong>{{ $contact->subject }}</strong></td>
                    </tr>
                </table>

                <!-- Message -->
                <div class="section-title">Query Content</div>
                <div class="message-box">{{ $contact->description }}</div>

                <!-- Action Button -->
                <div class="action-banner">
                    <p>Access the Contact Us management console to view and respond to messages.</p>
                    <a href="{{ url('/contact-us') }}" class="action-btn">Open Admin Panel</a>
                </div>
            </div>

            <!-- Footer -->
            <div class="email-footer">
                This is an automated notification from the <strong>Governor House Khyber Pakhtunkhwa</strong> web portal.<br>
                For technical support or portal administration, contact the IT Directorate.
            </div>
        </div>
    </div>
</body>
</html>

