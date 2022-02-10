<!doctype html>
<html lang="pt-BR">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amaranth:ital@1&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>M2 Code - QrCode Generator</title>
    <style>
        .qrcode-card {
            font-family: "Amaranth",Sans-serif;
        }

        .print {
            display: none;
        }

        @media print {
            .no-print {
                display: none;
            }
            div.print {
                float: left;
                display: flex;
            }
            div.container {
                width: 100%!important;
                float: left!important;
            }
            .card {
                border: none!important;
            }
            
        }
    </style>
</head>

<body >

    <div class="container">
        <main class="no-print">
            <div class="py-5 text-center">
                <!-- <img class="d-block mx-auto mb-4" src="/docs/5.1/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> -->
                <h2>QR CODE Generator</h2>
            </div>

            <div class="row g-5">
                <div class="col-md-6 col-lg-6 order-md-last">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-primary">Seu QR CODE</span>
                    </h4>
                    <div class="card flex-md-row mb-4 box-shadow qrcode-card" style="max-width: 300px; min-height: 110px;">
                        <div class="card-body d-flex flex-column align-items-start">
                        <h5 class="mb-0 text-center">
                        @isset($dados)
                            @if ($dados['nome'] !== '')
                            {!! $dados['texto'] !!}
                            @endif
                        @endif 
                        </h5>
                        @isset($dados['logomarca'])
                            <img class="card-img-left mt-2 flex-auto d-none d-md-block"  width="130" src="data:image/png;base64, @isset($dados)
                                @if ($dados['nome'] !== '')
                                    {!! $dados['logomarca']; !!}
                                @endif
                            @endif ">
                        @endif
                        </div>

                        
                        
                        <img class="card-img-right flex-auto d-none d-md-block" src="data:image/png;base64, @isset($dados)
                            @if ($dados['nome'] !== '')
                                {!! base64_encode(QrCode::format('png')->size($dados['tamanho'])->wiFi([
                                    'ssid' => $dados['nome'],
                                    'encryption' => $dados['criptografia'],
                                    'password' => $dados['senha']
                                ])); !!}
                            @endif
                        @endif ">
                        <!-- <img class="card-img-right flex-auto d-none d-md-block" data-src="holder.js/200x250?theme=thumb" alt="Thumbnail [200x250]" style="width: 200px; height: 250px;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22250%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20250%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_17edf358cf9%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A13pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_17edf358cf9%22%3E%3Crect%20width%3D%22200%22%20height%3D%22250%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2256.1953125%22%20y%3D%22131%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true"> -->
                    </div>
                    <button type="buttom" onClick="window.print()" class="btn btn-primary">Imprimir</button>
                </div>
                <div class="col-md-6 col-lg-6">
                    <h4 class="mb-3">WiFi QR CODE</h4>
                    <form class="needs-validation" novalidate="" id="formulario" method="POST" action="qrcode" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="nome" class="form-label">Nome da Rede</label>
                                <input type="text" class="form-control" id="nome" placeholder="" name="nome" value="" required="">
                            </div>

                            <div class="col-sm-6">
                                <label for="senha" class="form-label">Senha</label>
                                <input type="text" class="form-control" id="senha" name="senha" placeholder="" value="" required="">
                            </div>

                            <div class="col-sm-6">
                                <label for="texto" class="form-label">Texto</label>
                                <input type="text" class="form-control" id="texto" placeholder="" name="texto" value="Escaneie para conectar!" required="">
                            </div>

                            <div class="col-sm-6">
                                <label for="tamanho" class="form-label">Tamanho</label>
                                <input type="text" class="form-control" id="tamanho" placeholder="" name="tamanho" value="130" required="">
                            </div>
                            <div class="col-sm-12">
                                <label for="logo" class="form-label">Logo Descrição</label>
                                <input type="file" class="form-control" id="logo" placeholder="" name="logo" required="">
                            </div>
                            <!-- <div class="col-sm-12">
                                <label for="logoqr" class="form-label">Logo QRCODE</label>
                                <input type="file" class="form-control" id="logoqr" placeholder="" name="logoqr" required="">
                            </div> -->
                        </div>

                        <hr class="my-4">

                        <h4 class="mb-3">Criptografia</h4>

                        <div class="my-3">
                            <div class="form-check">
                                <input id="nenhuma" name="criptografia" type="radio" class="form-check-input" value="nenhum" required="">
                                <label class="form-check-label" for="nenhuma">Nenhuma</label>
                            </div>
                            <div class="form-check">
                                <input id="wpa" name="criptografia" type="radio" class="form-check-input" checked="" value="WPA" required="">
                                <label class="form-check-label" for="wpa">WPA/WPA2</label>
                            </div>
                            <div class="form-check">
                                <input id="paypal" name="criptografia" type="radio" class="form-check-input" value="WEP" required="">
                                <label class="form-check-label" for="wep">WEP</label>
                            </div>
                        </div>
                        
                        <hr class="my-4">

                        <button class="w-100 btn btn-primary btn-lg" id="criarQR" type="submit">Gerar QR CODE</button>
                    </form>
                </div>
            </div>
        </main>

        <div class="card flex-md-row print qrcode-card" style="max-width: 300px; min-height: 110px;">
            <div class="card-body d-flex flex-column align-items-start">
            <h5 class="mb-0 text-center">
            @isset($dados)
                @if ($dados['nome'] !== '')
                {!! $dados['texto'] !!}
                @endif
            @endif 
            </h5>
            @isset($dados['logomarca'])
                <img class="card-img-left mt-2 flex-auto d-none d-md-block"  width="130" src="data:image/png;base64, @isset($dados)
                    @if ($dados['nome'] !== '')
                        {!! $dados['logomarca']; !!}
                    @endif
                @endif ">
            @endif
            </div>

            
            
            <img class="card-img-right flex-auto d-none d-md-block" src="data:image/png;base64, @isset($dados)
                @if ($dados['nome'] !== '')
                    {!! base64_encode(QrCode::format('png')->size($dados['tamanho'])->wiFi([
                        'ssid' => $dados['nome'],
                        'encryption' => $dados['criptografia'],
                        'password' => $dados['senha']
                    ])); !!}
                @endif
            @endif ">
            <!-- <img class="card-img-right flex-auto d-none d-md-block" data-src="holder.js/200x250?theme=thumb" alt="Thumbnail [200x250]" style="width: 200px; height: 250px;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22250%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20250%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_17edf358cf9%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A13pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_17edf358cf9%22%3E%3Crect%20width%3D%22200%22%20height%3D%22250%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2256.1953125%22%20y%3D%22131%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true"> -->
        </div>

        <!-- <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">© 2017–2021 Company Name</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Privacy</a></li>
                <li class="list-inline-item"><a href="#">Terms</a></li>
                <li class="list-inline-item"><a href="#">Support</a></li>
            </ul>
        </footer> -->
    </div>

</body>

</html>