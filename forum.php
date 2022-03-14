<?php include "php/head.php"; ?>
<?php include "php/header.php"; ?>

<div class="section">
	<header>Forum</header>
    <div class="infobox">
        <div class="infologo">&#9872;</div>
        <div class="infotext">
            Neueste Kommentare der "Schachfibel"-Community. Im unter liegenden Feld kann ein eigener Kommentar gestellt werden.
        </div>
    </div>
    
    <?php
        if (isset($_SESSION["loggedUserId"])) { 
            $userName = $SchachfibelDAO->getUser($_SESSION["loggedUserId"])["name"];     
        }
        $editComment;
        $forumpostNamespace = "forumpost-";
        $forumpostNamespaceDelete = $forumpostNamespace . "delete-";
        $forumpostNamespaceEdit = $forumpostNamespace . "edit-";
        $forumpostNamespaceEditSubmit = $forumpostNamespaceEdit . "submit-";
        $forumpostNamespaceLike = $forumpostNamespace . "like-";
        if (isset($_SESSION["loggedUserId"])) {
			if (isset($_SESSION["token"]) && isset($_POST["token"]) && $_SESSION["token"] == $_POST["token"]) {
				foreach($_POST as $index => $post) {
					if (substr($index, 0, strrpos($index,"-") + 1) === $forumpostNamespaceDelete) {
						$postId = (int) substr($index, strrpos($index,"-") + 1, strrpos($index,"_") - strrpos($index,"-") - 1);
						$SchachfibelDAO->deleteForumPost($postId, $_SESSION["loggedUserId"]);
						break;
					}
				}
				foreach($_POST as $index => $post) {
					if (substr($index, 0, strrpos($index,"-") + 1) === $forumpostNamespaceEdit) {
						$postId = (int) substr($index, strrpos($index,"-") + 1, strrpos($index,"_") - strrpos($index,"-") - 1);
						if ($SchachfibelDAO->isUserForumPostAuthor($postId, $_SESSION["loggedUserId"])) {
							$editComment = $postId;
							break;
						}
					}
				}
				foreach($_POST as $index => $post) {
					if (substr($index, 0, strrpos($index,"-") + 1) === $forumpostNamespaceEditSubmit) {
						$postId = (int) substr($index, strrpos($index,"-") + 1);
						if ($SchachfibelDAO->isUserForumPostAuthor($postId, $_SESSION["loggedUserId"])) {
							$message = html_entity_decode($_POST["kommentar"]);
							$isEdited = $SchachfibelDAO->editForumPost($postId, $_SESSION["loggedUserId"], $message);
							if (!$isEdited) {
								$_POST["forumKeepPostInTextarea"] = $_POST["kommentar"];
							}
							break;
						}
					}
				}
				foreach($_POST as $index => $post) {
					if (substr($index, 0, strrpos($index,"-") + 1) === $forumpostNamespaceLike) {
						$postId = (int) substr($index, strrpos($index,"-") + 1);
						$SchachfibelDAO->likeForumPost($postId, $_SESSION["loggedUserId"]);
						break;
					}
				}
			}
            if (!isset($editComment)) { ?>
                <div id="kommentar-label">
                    <label for="kommentar">Einen neuen Kommentar erstellen</label>
                </div>
				<?php
                	if (array_key_exists("forumCreatePost", $_POST)
						&& isset($_SESSION["token"]) && isset($_POST["token"]) && $_SESSION["token"] == $_POST["token"]) {
                    	$message = html_entity_decode($_POST["kommentar"]);
                        $isCreated = $SchachfibelDAO->createForumPost($_SESSION["loggedUserId"], $message);
						if (!$isCreated) {
							$_POST["forumKeepPostInTextarea"] = $_POST["kommentar"];
						}
                    }
                ?>
                <form method="post">
                    <textarea id="kommentar" name="kommentar" placeholder="Neuer Kommentar..."><?php
                            if (array_key_exists("forumCancelPost", $_POST)
							   && isset($_SESSION["token"]) && isset($_POST["token"]) && $_SESSION["token"] == $_POST["token"]) {
                                $SchachfibelDAO->cancelForumPost();
                            }
							else if (array_key_exists("forumKeepPostInTextarea", $_POST)) {
								echo $_POST["forumKeepPostInTextarea"];
							}
                    ?></textarea>
                    <div class="button-box">
                        
                        <input class="button2" type="submit" name="forumCreatePost" value="Kommentar posten">
                        <input class="button2" type="submit" name="forumCancelPost" value="Kommentar abbrechen">
						<input type="hidden" name="token" value="<?php echo $_SESSION["token"]; ?>" />
                    </div>
                </form>
    <?php }
    } ?>

    <?php
    
        $forumPosts = $SchachfibelDAO->getForumPosts();
        if (!isset($forumPosts)) {?>
            <div class="forumpost-error">
                Fehler: Es konnten keine Forumbeiträge geladen werden
            </div>
        <?php } else {
            if (sizeof($forumPosts) === 0) { ?>
                <div class="forumpost-error">
                    Es sind noch keine Kommentare vorhanden.
                </div>
            <?php } ?>
            <?php foreach ($forumPosts as $index => $post) {
                /*$post->setPostId(null);
                $post->setUserId(null);
                $post->setDate(null);
                $post->setMessage(null);
                $post->setEdited(null);
                $post->setEditDate(null);
                $post->setUserLikeIds(null);*/
                if (!isset($post) || get_class($post) != "ForumPost") { ?>
                    <div class="forumpost-error">
                        Fehler: Der Kommentar konnte nicht geladen werden.
                    </div>
                    <?php continue; ?>
                <?php }
                if (null === $post->getPostId()) { ?>
                    <div class="forumpost-error">
                        Fehler: Der Kommentar hat keine Id und kann somit nicht verändert werden.
                    </div>
                <?php } ?>
                <?php
                    $postLikeValid = is_array($post->getUserLikeIds());
                    if (!$postLikeValid) { ?>
                        <div class="forumpost-error">
                            Fehler: Die Likes des Kommentars konnten nicht ermittelt werden.
                        </div>
                <?php } ?>
                <?php if (!(isset($editComment)) || $editComment !== (int) $post->getPostId()) {
            ?>
                <div class="forumpost">
                    <div class="forumpost-header">
                        <?php
                                $postUser = $SchachfibelDAO->getUser($post->getUserId());
                                if (!isset($postUser)) { ?>
                                    <div class="forumpost-header-error">
                                        Fehler: Der Autor des Kommentars konnte nicht geladen werden.
                                    </div>
                                <?php } else { ?>
                                    <?php
                                    $postUserpicture = $postUser["image"];
                                    if (!isset($postUserpicture) || empty($postUserpicture)) { ?>
                                        <div class="forumpost-header-error">
                                            Fehler: Das Bild konnte nicht geladen werden.
                                        </div>
                                    <?php } else { ?>
                                        <img src="<?php echo htmlspecialchars($postUserpicture); ?>" alt="profilbild">
                                    <?php } ?>
                        <div class="forumpost-author">
                                <?php
                                    $postUsername = $postUser["name"];
                                    if (!isset($postUsername) || !is_string($postUsername)) { ?>
                                        Fehler: Der Name konnte nicht geladen werden.
                                    <?php } else {
                                        echo htmlspecialchars($postUsername);
                                    }
                        ?></div><?php } ?>
                    </div>
                    <div class="forumpost-body">
                        <div class="forumpost-date"><?php
                            $postDate = $post->getDate();
                            if (!isset($postDate)) { ?>
                                Fehler: Das Datum konnte nicht geladen werden.
                            <?php } else {
                                echo htmlspecialchars($postDate);
                            }
                        ?></div>
                        <div class="forumpost-button">
                            <form method="post">
                                <?php if (isset($_SESSION["loggedUserId"]) && $postLikeValid) { ?>
                                    <?php if ($_SESSION["loggedUserId"] === $post->getUserId()) { ?>
                                        <input type="image" name=<?php echo $forumpostNamespaceEdit . $post->getPostId(); ?> alt="Editieren" src="images/icons/edit.png"/>
                                        <input type="image" name=<?php echo $forumpostNamespaceDelete . $post->getPostId(); ?> alt="Mülleimer" src="images/icons/muelleimer.png">
                                    <?php } ?>
									<?php $postId = $post->getPostId(); ?>
                                    <input type="image" id="forumpost-like-<?php echo $postId; ?>"
										   name=<?php echo $forumpostNamespaceLike . htmlspecialchars($postId); ?> src=
                                        <?php if (isset($_SESSION["loggedUserId"])
												  && htmlspecialchars($post->hasUserLikeId($_SESSION["loggedUserId"]))) { ?>
                                        		"images/icons/herz.png" alt="Herz voll">
                                        <?php } else { ?>
                                                "images/icons/herz-leer.png" alt="Herz leer">
                                        <?php } ?>
                                    
                                <?php } else { ?>
                                    <img src="images/icons/herz-leer.png" alt="Herz leer">
                                <?php } ?>
								<input type="hidden" name="token" value="<?php echo $_SESSION["token"]; ?>"/>
                            </form>
                            <p class=
                                <?php if (isset($_SESSION["loggedUserId"]) && htmlspecialchars($post->hasUserLikeId($_SESSION["loggedUserId"]))) {
                                    echo "\"forumpost-likes-true\">";
                                }
                                else {
                                    echo "\"forumpost-likes-false\">";
                                } ?>
                                
                                <?php
									$userLikeCount = $post->countUserLikeId();
									$userLikeCount = htmlspecialchars($userLikeCount);
									if (isset($_SESSION["loggedUserId"]) && $postLikeValid) { ?>
                                    <label for="forumpost-like-<?php echo $postId; ?>">
                                        <?php echo $userLikeCount; ?>
                                    </label>
                                <?php } else {
                                    echo $userLikeCount;
                                } 
                            ?></p>
                        </div>
                        <div class="forumpost-message">
                            <?php
                                $postMessage = htmlspecialchars($post->getMessage());
                                if (!isset($postMessage) || !is_string($postMessage) || empty($postMessage)) { ?>
                                    Fehler: Nachricht konnte nicht geladen werden.
                                <?php } else {
                                    echo $postMessage;
                                }
                                $postIsEdited = $post->isEdited();
								$postIsEdited = htmlspecialchars($postIsEdited);
                                if (!isset($postIsEdited) || $postIsEdited != 0 && $postIsEdited != 1) { ?>
                                    <br><div class="forumpost-date-edit">
                                        Fehler: Es kann nicht festgestellt werden, ob der Kommentar editiert wurde.
                                    </div>
                                <?php } else { ?>
                                <?php if ($postIsEdited == 1) { 
                                    $postEditDate = $post->getEditDate();
									$postEditDate = htmlspecialchars($postEditDate);
                                    if (!isset($postEditDate) || !is_string($postEditDate)) {
                                        $postEditDate = "\"Fehler: Das Datum konnte nicht geladen werden.\"";
                                    }
                                    ?><br><div class="forumpost-date-edit">[Zuletzt editiert <?php echo $postEditDate ?>]</div>
                                <?php }
								}
                        ?></div>
                    </div>
                </div>
                <?php } else { ?>
                    <div id="kommentar-label">
                        <label for="kommentar">Einen alten Kommentar bearbeiten</label> 
                    </div>
                    <form method="post">
                        <textarea id="kommentar" name="kommentar" placeholder="Kommentar bearbeiten..."><?php
                            echo html_entity_decode($post->getMessage()); 
                        ?></textarea>
                        <div class="button-box">
                            <input class="button2" type="submit"
								   name=<?php echo $forumpostNamespaceEditSubmit . htmlspecialchars($post->getPostId()); ?>
								   value="Änderung speichern">
                            <input class="button2" type="submit" name="forumCancelPost" value="Änderung abbrechen">
							<input type="hidden" name="token" value="<?php echo $_SESSION["token"]; ?>"/>
                        </div>
                    </form>
                <?php }
            }
        } ?>
</div>

<?php include "php/footer.php"; ?>
