<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Radio Mahananda - Secure Access</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tiro+Bangla:ital@0;1&display=swap');
        .bengali-font { font-family: 'Tiro Bangla', serif; }
    </style>
</head>
<body class="font-sans antialiased bg-slate-100 min-h-screen flex flex-col justify-center items-center py-10">

    <div class="w-full max-w-md px-8 py-10 bg-white shadow-[0_20px_50px_rgba(8,_112,_184,_0.07)] rounded-2xl relative overflow-hidden border border-slate-100">

        <div class="absolute top-0 left-0 w-full h-2 flex">
            <div class="h-full w-1/2 bg-red-600"></div>
            <div class="h-full w-1/2 bg-[#00a8e8]"></div>
        </div>

        <div class="text-center mb-8 mt-2">
            <h1 class="text-4xl font-extrabold text-slate-800 tracking-tight bengali-font mb-2">
                রেডিও মহানন্দা
            </h1>
            <h2 class="text-xl font-bold text-red-600 bengali-font">
                ৯৮.৮ এফ এম
            </h2>
        </div>

        {{ $slot }}

    </div>

    <div class="mt-8 text-center text-xs text-slate-500 font-medium">
        &copy; {{ date('Y') }} Radio Mahananda 98.8FM. Secured Access Platform.<br>
        Maintained by Proyas IT.
    </div>
    
</body>
</html>