<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Citizen Submission - Talk to the Governor</title>
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
            background-color: #142820;
            padding: 26px 30px 20px;
            border-bottom: 4px solid #FECB00;
        }
        .email-header .badge {
            display: inline-block;
            background-color: #FECB00;
            color: #142820;
            font-size: 11px;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 4px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 8px;
        }
        .email-header h1 {
            color: #ffffff;
            font-size: 19px;
            margin: 0 0 4px 0;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .email-header .sub-title {
            color: #d1d5db;
            font-size: 12.5px;
            margin: 0;
        }
        .email-body {
            padding: 28px 30px;
        }
        .summary-bar {
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 14px 18px;
            margin-bottom: 24px;
        }
        .summary-bar table {
            width: 100%;
        }
        .summary-bar td {
            padding: 4px 8px;
            font-size: 13px;
        }
        .ref-pill {
            display: inline-block;
            background-color: #142820;
            color: #FECB00;
            font-family: 'Courier New', Courier, monospace;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 13.5px;
        }
        .section-title {
            font-size: 13.5px;
            font-weight: 700;
            color: #142820;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 24px 0 12px;
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
            width: 30%;
            font-weight: 600;
            color: #4b5563;
            background-color: #f9fafb;
        }
        .details-table td.value-col {
            color: #111827;
        }
        .details-table a {
            color: #047857;
            text-decoration: none;
            font-weight: 600;
        }
        .message-box {
            background-color: #ffffff;
            border: 1px solid #e5e7eb;
            border-left: 4px solid #FECB00;
            border-radius: 6px;
            padding: 16px 18px;
            font-size: 14px;
            line-height: 1.6;
            color: #1f2937;
            white-space: pre-wrap;
            margin-bottom: 24px;
        }
        .attachments-list {
            list-style: none;
            padding: 0;
            margin: 0 0 24px 0;
        }
        .attachments-list li {
            padding: 8px 12px;
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            margin-bottom: 8px;
            font-size: 13px;
        }
        .attachments-list li a {
            color: #047857;
            text-decoration: none;
            font-weight: 600;
            margin-left: 6px;
        }
        .btn-portal {
            display: inline-block;
            background-color: #142820;
            color: #ffffff !important;
            padding: 12px 24px;
            font-size: 13.5px;
            font-weight: 600;
            text-decoration: none;
            border-radius: 6px;
            text-align: center;
        }
        .btn-container {
            text-align: center;
            margin: 26px 0 10px;
        }
        .reply-hint {
            font-size: 12.5px;
            color: #6b7280;
            font-style: italic;
            text-align: center;
            margin-top: 10px;
        }
        .email-footer {
            background-color: #f9fafb;
            border-top: 1px solid #e5e7eb;
            padding: 20px 30px;
            text-align: center;
            font-size: 12px;
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-container">
            <!-- Header -->
            <div class="email-header">
                <span class="badge">Governor Secretariat Alert</span>
                <h1>New Citizen Message Received</h1>
                <p class="sub-title">Portal: Talk to the Governor • Governor House Peshawar</p>
            </div>

            <!-- Body -->
            <div class="email-body">
                <!-- Summary bar -->
                <div class="summary-bar">
                    <table>
                        <tr>
                            <td><strong>Reference:</strong> <span class="ref-pill">{{ $submission->reference_number }}</span></td>
                            <td align="right"><strong>Date:</strong> {{ $submission->created_at ? $submission->created_at->format('d M, Y - h:i A') : now()->format('d M, Y - h:i A') }}</td>
                        </tr>
                        <tr>
                            <td><strong>District:</strong> {{ $submission->district }}</td>
                            <td align="right"><strong>Category:</strong> {{ $submission->category }}</td>
                        </tr>
                    </table>
                </div>

                <!-- Citizen Information -->
                <div class="section-title">Citizen Information</div>
                <table class="details-table">
                    <tr>
                        <td class="label-col">Full Name:</td>
                        <td class="value-col"><strong>{{ $submission->name }}</strong></td>
                    </tr>
                    <tr>
                        <td class="label-col">Email Address:</td>
                        <td class="value-col"><a href="mailto:{{ $submission->email }}">{{ $submission->email }}</a></td>
                    </tr>
                    <tr>
                        <td class="label-col">Mobile Number:</td>
                        <td class="value-col"><a href="tel:{{ $submission->mobile_number }}">{{ $submission->mobile_number }}</a></td>
                    </tr>
                    <tr>
                        <td class="label-col">CNIC:</td>
                        <td class="value-col">{{ $submission->cnic ?: 'Not provided' }}</td>
                    </tr>
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
                </table>

                <!-- Message -->
                <div class="section-title">Message / Grievance Details</div>
                <div class="message-box">{{ $submission->message }}</div>

                <!-- Attachments -->
                @if ($submission->document || !empty($submission->images_list))
                <div class="section-title">Uploaded Files (Also attached to this email)</div>
                <ul class="attachments-list">
                    @if ($submission->document)
                    <li>
                        <strong>PDF Document:</strong>
                        <a href="{{ asset($submission->document) }}" target="_blank" rel="noopener noreferrer">View/Download PDF ({{ basename($submission->document) }})</a>
                    </li>
                    @endif
                    @if (!empty($submission->images_list))
                        @foreach ($submission->images_list as $index => $img)
                        <li>
                            <strong>Photo #{{ $index + 1 }}:</strong>
                            <a href="{{ asset($img) }}" target="_blank" rel="noopener noreferrer">View Image ({{ basename($img) }})</a>
                        </li>
                        @endforeach
                    @endif
                </ul>
                @endif

                <!-- Action Button -->
                <div class="btn-container">
                    <a href="{{ url('/talk-to-governors') }}" class="btn-portal">
                        Open Submissions in Admin Portal &rarr;
                    </a>
                </div>
                <div class="reply-hint">
                    Tip: You can hit <strong>Reply</strong> to respond directly to the citizen at <em>{{ $submission->email }}</em>.
                </div>
            </div>

            <!-- Footer -->
            <div class="email-footer">
                Governor's Secretariat, Governor House Peshawar, Khyber Pakhtunkhwa, Pakistan<br>
                Official Website: <a href="{{ config('app.url') }}" style="color:#142820; text-decoration:none;">{{ config('app.url') }}</a>
            </div>
        </div>
    </div>
</body>
</html>

