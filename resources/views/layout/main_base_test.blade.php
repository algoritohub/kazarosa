<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Base de Test</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <!--  -->
    <header class="w-[100%] inline-block h-[33.3vh] bg-[blue]">
        <!--  -->
        <div class="w-[90%] mx-[5%] bg-[silver] h-[97%] inline-block">
            <!--  -->
            <div class="w-[100%] inline-block bg-[purple] h-[35%]"></div>
            <!--  -->
            <div class="w-[100%] inline-block bg-[yellow] h-[28%]"></div>
            <!--  -->
            <div class="w-[100%] inline-block bg-[green] h-[28%]"></div>
        </div>
    </header>
    <!--  -->
    <section class="w-[100%] inline-block h-[56.3vh] bg-[red]">
        @yield('content')
    </section>
    <!--  -->
    <footer class="w-[100%] inline-block h-[10.3vh] bg-[yellow]">
        <center>
            <ul class="mt-[20px] ml-[20px]">
                <li class="inline-block mr-[40px]">X</li>
                <li class="inline-block mr-[40px]">X</li>
                <li class="inline-block mr-[40px]">X</li>
                <li class="inline-block mr-[40px]">X</li>
                <li class="inline-block mr-[40px]">X</li>
            </ul>
        </center>
    </footer>
</body>
</html>
