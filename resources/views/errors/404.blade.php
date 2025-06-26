<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page non trouvée</title>
    <style>
        body { text-align: center; padding: 50px; font-family: Arial, sans-serif; }
        h1 { font-size: 50px; }
        p { font-size: 20px; }
    </style>
</head>
<body>
<h1>404</h1>
<p>Oups ! La page que vous recherchez n'existe pas.</p>
<a href="{{ url()->previous() }}" class="btn btn-primary">Retour à la page précédente</a>

</body>
</html>
