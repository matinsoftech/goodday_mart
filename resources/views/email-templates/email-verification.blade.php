<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ translate('Email Verification') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Optionally keep or remove external CSS link --}}
    <link rel="stylesheet" href="{{ dynamicAsset(path: 'public/assets/back-end/css/email-basic.css') }}">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #639cd9 20%, #e1eec3 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        .verification-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 6px 32px 0 rgba(60, 80, 180, 0.13), 0 1.5px 4px 0 rgba(40, 80, 60, 0.11);
            padding: 35px 36px 28px 36px;
            max-width: 420px;
            width: 100%;
            text-align: center;
            animation: fadein 1.1s;
        }

        @keyframes fadein {
            from {
                opacity: 0;
                transform: scale(0.98);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .brand-header {
            margin-bottom: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .brand-logo {
            width: 64px;
            height: 64px;
            border-radius: 14px;
            background: #f8fafc;
            margin-bottom: 5px;
            box-shadow: 0 2px 6px rgba(60, 80, 200, 0.08);
        }

        .brand-title {
            font-size: 1.25rem;
            color: #4070fa;
            font-weight: 700;
            margin-bottom: 3px;
            letter-spacing: .8px;
        }

        .card-title {
            color: #323a49;
            font-weight: 600;
            font-size: 1.16rem;
            margin-bottom: 16px;
            letter-spacing: .7px;
        }

        .verification-code {
            font-size: 2.7rem;
            padding: 12px 0;
            color: #078beb;
            font-weight: 650;
            letter-spacing: 12px;
            background: linear-gradient(90deg, #e4f1fb 60%, #d2e6fa 100%);
            border-radius: 13px;
            margin: 8px 0 18px 0;
            box-shadow: 0 1.5px 7px 0 rgba(7, 139, 235, 0.08);
            user-select: all;
        }

        .instruction {
            color: #888;
            font-size: 1rem;
            margin-bottom: 18px;
        }

        .footer-info {
            font-size: 0.96rem;
            color: #a5a5aa;
            margin-top: 16px;
        }

        @media (max-width: 576px) {
            .verification-card {
                padding: 23px 8px 16px 8px;
                max-width: 98vw;
            }

            .brand-logo {
                width: 45px;
                height: 45px;
            }
        }
    </style>
</head>

<body>
    <?php
    $companyPhone = getWebConfig(name: 'company_phone');
    $companyEmail = getWebConfig(name: 'company_email');
    $companyName = getWebConfig(name: 'company_name');
    $companyLogo = getWebConfig(name: 'company_web_logo');
    ?>
    <div class="verification-card">
        <div class="brand-header">
            @if (is_file('storage/app/public/company/' . $companyLogo))
                <img src="{{ dynamicStorage(path: 'storage/app/public/company/' . $companyLogo) }}"
                    alt="{{ $companyName }}" class="brand-logo">
            @endif
            <div class="brand-title">
                {{ $companyName }}
            </div>
        </div>
        <div class="card-title">
            {{ translate('Verify_your_email') }}
        </div>
        <div class="instruction">
            {{ translate('Enter this code to complete your registration:') }}
        </div>
        <div class="verification-code">
            {{ $token }}
        </div>
        <div class="footer-info">
            @if ($companyEmail)
                📧 {{ $companyEmail }}<br>
            @endif
            @if ($companyPhone)
                ☎️ {{ $companyPhone }}
            @endif
        </div>
    </div>
</body>

</html>
