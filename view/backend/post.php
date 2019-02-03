<a href="admin.php"><button class="btn btn-primary">Voir la liste des articles</button></a>

<div>
    <h1><?= $titlePage['titleSection']; ?></h1>

    <div>
        <form method="POST" action="admin.php?action=post">
            <p>
                <label for="titlePost"><?= $titlePage['titlePost']; ?></label><br>
                <input type="text" name="titlePost" id="titlePost"
                <?php if(isset($_GET['postId'])) { echo 'value="' . $post->title() . '"'; } ?>
                required>
            </p>
            <p>
                <label for="contentPost"><?= $titlePage['labelContentPost']; ?></label><br>
                <textarea name="contentPost">
                    <?php if(isset($_GET['postId'])) { echo $post->content(); } ?>
                </textarea>
            </p>
            <p>
                <?php
                if(isset($_GET['change']) && ($_GET['change'] == 'on'))
                {
                ?>
                    <input type="hidden" name="change" value="on">
                    <input type="hidden" name="postId" value="<?= $_GET['postId']; ?>">
                <?php
                }
                else
                {
                ?>
                    <input class="btn btn-success" type="hidden" name="addPost" value="add">
                <?php
                }
                ?>

                <input class="btn btn-success" type="submit" value="<?= $titlePage['buttonSend']; ?>"> 
            </p>
        </form>
    </div>

</div>