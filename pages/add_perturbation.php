<?php include '../includes/header.php';?>
<div class="update-container">
    <h2>Nouvelle Diffusion</h2>
    <form 
        action="<?php echo 'form_result.php?type=' . $_GET['type'] . '&id=' . $_GET['id']; ?>" 
        method="post" 
        class="update-form"
    >
        <label for="description">Description</label>
        <input name="description" type="text" id="description" required>

        <label for="start">Début</label>
        <input 
            name="start" 
            type="datetime-local" 
            id="start" 
            min="2010-01-01T00:00" 
            max="2030-12-31T23:59" 
            required
        >

        <label for="end">Fin</label>
        <input 
            name="end" 
            type="datetime-local" 
            id="end" 
            min="2010-01-01T00:00" 
            max="2030-12-31T23:59" 
            required
        >

        <button type="submit" class="btn">Diffuser</button>
    </form>
</div>

<?php
    require_once '../session.php';
    include '../includes/footer.php';
?>
