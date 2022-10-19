<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulário</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<div class="container my-5">

    
    <?php 


    if(!empty($posts)){

    ?>



    <section class="articles_list">
        <?php 

        foreach($posts as $post){

        ?>
        <article class="mb-5">
            <a href="{{ route('posts.create') }} " class="btn btn-success mb-5">Cadastrar novo artigo</a>
            <a href="{{ route('posts.trashed') }} " class="btn btn-warning mb-5">Ver Lixeira</a>

            <h1>{{ $post->title }}</h1>
            <h2>{{ $post->subtitle }}</h2>
            <p>{{ $post->description }}</p>
            <small>Criado em - {{ date('d/m/Y H:i:s', strtotime($post->created_at)) }} - Editado em - {{ date('d/m/Y H:i:s', strtotime($post->updated_at)) }}</small>
                
            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">EDITAR</a>
             <form action="{{ route('posts.destroy', $post->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">EXCLUIR</button>
             </form>
        </article>
        <hr>

        <?php }?>
    </section>
    <?php
    }
    ?>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>