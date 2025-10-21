<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Erreur</title>
</head>
<body>
    <div class="error-box">
        <h1>Oups ! Une erreur est survenue</h1>
        <p><?= htmlspecialchars($errorMessage) ?></p>
        <a href="index.php">Retour à l'accueil</a>
    </div>
</body>
</html>
