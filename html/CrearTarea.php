<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Crear Tarea</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
</head>

<body>

    <div class="page-content">

        <div class="form-wrapper">
            <div class="form-container">
                <form method="get" action="com/main.php">
                    <input type="hidden" name="action" value="newtask">

                    <!-- Row 2 -->
                    <div class="form-row">
                        <h1>LIST</h1>
                        <div class="form-row name">
                            <div class="form-group">
                                <label for="title">Title of the list</label><br>
                                <input id="title" type="text" name="ltitle" size="50"> <br><br>
                            </div>

                            <div class="form-group">
                                <label for="description">Description of the list</label><br>
                                <input id="description" type="text" name="ldescription" size="250"><br>
                            </div>

                            <div class="form-group">
                                <label for="location">Participants</label><br>
                                <input id="participants" type="text" name="participants[]" size="250"><br>
                                <input id="participants" type="text" name="participants[]" size="250"><br>
                            </div>
                        </div>
                        <br>
                        <h1>TASK</h1>
                        <div class="form-row name">
                            <div class="form-group">
                                <label for="title">Title of the task</label><br>
                                <input id="title" type="text" name="ttitle" size="50"> <br><br>
                            </div>

                            <div class="form-group">
                                <label for="description">Description of the task</label><br>
                                <input id="description" type="text" name="tdescription" size="250"><br>
                            </div>
                        </div>
                        <br>
                        <div class="date-container">
                            <label for="fecha" class="fecha-label">Select the deadline:</label><br>
                            <input type="date" id="date" name="date" required><br><br>
                        </div>
                    </div>

                    <!-- Row 3 -->
                    <div class="form-row location">
                        <div class="form-group">
                            <label for="location">location</label><br>
                            <input id="location" type="text" name="location" size="250"><br>
                        </div>
                    </div>
                    <br>
                    <input class="boton-actualizar" type="submit" name="Insertar" value="Insertar">
                </form>
</body>