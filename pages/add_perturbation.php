<form action=<?php echo "form_result.php?type=" . $_GET['type'] . "&id=" . $_GET['id']?> method="post">
    <label>
        Description
        <input name ="description" type="text">
    </label>
    <label>
        Début
        <input name="start" type="datetime-local" min="2010-01-01T00:00" max="2030-12-31T23:59">
    </label>
    <label>
        Fin
        <input name="end" type="datetime-local" min="2010-01-01T00:00" max="2030-12-31T23:59">
    </label>
    <button action="submit"> Diffuser </button>
</form>

<?php
    require_once '../session.php';
?>