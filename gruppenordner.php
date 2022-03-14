<?php include "php/head.php"; ?>
<?php include "php/header.php"; ?>

<div class="section">
	<div class="grid-gruppenordner">

		<div class="text-gruppenordner">
			<header>Gruppenordner</header>
			<div class="infobox">
				<div class="infologo">&#9872;</div>
				<div class="infotext">Hier sind Materialien zu finden, die von anderen Nutzer*innen hochgeladen worden sind.</div>
			</div>
			<?php              
            if (isset($_SESSION["loggedUserId"])) { 
                $userName = $SchachfibelDAO->getUser($_SESSION["loggedUserId"])["name"];     
            }
            
                $gruppenordnerNamespace = "forumpost-";
                $gruppenordnerNamespaceDelete = $gruppenordnerNamespace . "delete-";
                $gruppenordnerNamespaceEdit = $gruppenordnerNamespace . "edit-";
                $gruppenordnerNamespaceEditSubmit = $gruppenordnerNamespaceEdit . "submit-";
                $gruppenordnerNamespaceLike = $gruppenordnerNamespace . "like-"; ?>
			<?php
                if (isset($_SESSION["loggedUserId"])) {
					if (isset($_SESSION["token"]) && isset($_POST["token"]) && $_SESSION["token"] == $_POST["token"]) {
						foreach($_POST as $index => $post) {
							if (substr($index, 0, strrpos($index,"-") + 1) === $gruppenordnerNamespaceDelete) {
								$fileId = (int) substr($index, strrpos($index,"-") + 1, strrpos($index,"_") - strrpos($index,"-") - 1);
								$deletedFile = $SchachfibelDAO->deleteGruppenordnerFile($fileId, $id); # $_SESSION["loggedUserId"]);
								if (isset($deletedFile)) {
									$filePath = $deletedFile->getPath();
									if (!file_exists($filePath)) { 
				?>
			<div class="grupp">
				<p>
					Datei existiert nicht!
				</p>
			</div>
			<?php               } else {
										if (unlink($filePath)) { ?>
			<div class="grupp">
				<p>
					Datei wurde erfolgreich gelöscht
				</p>
			</div>
			<?php                   } else { ?>
			<div class="grupp">
				<p>
					Datei konnte nicht gelöscht werden
				</p>
			</div>
			<?php                   } 
									}
									break;
								}
							}
						}
					}
                }
            ?>

			<?php   if (isset($_SESSION["loggedUserId"]) && isset($_FILES["file"])
					   && isset($_SESSION["token"]) && isset($_POST["token"]) && $_SESSION["token"] == $_POST["token"]) {
                    	$fileType = new SplFileInfo($_FILES["file"]["name"]);
                        $fileType = strtolower($fileType->getExtension());
                        $allowed_extensions = array("jpg", "jpeg", "jpe", "png", "gif", "txt", "pdf");
                        if ($_FILES["file"]["size"] > Utils::MB * 20) { ?>
			<div class="grupp">
				<p>
					Es dürfen nur Dateien kleiner als 20 MB hochgeladen werden
				</p>
			</div>
			<?php    } else if (!in_array($fileType, $allowed_extensions)) { ?>
			<div class="grupp">
				<p>
					Es dürfen Dateien nur in den folgenden Formaten hochgeladen werden:
				</p>
			</div>
			<?php
                for ($i = 0; $i < sizeof($allowed_extensions) - 1; $i++) {
                    echo " " . $allowed_extensions[$i] . ",";
                }
                if (sizeof($allowed_extensions) > 0) {
                    echo " " . end($allowed_extensions) . ".";
                }
                        } else if (strlen($_FILES["file"]["name"]) > 30) {
                ?>
			<div class="grupp">
				<p>
					Der Dateiname darf maximal 30 Zeichen lang sein.
				</p>
			</div>
			<?php
                        } else {
                        if (isset($_FILES["file"])) {
                            $fileSize = Utils::convertBytesToString($_FILES["file"]["size"]);
                            $fileName = htmlspecialchars($_FILES["file"]["name"]);
                            $path = "php/gruppenordner/";
                            // create $path if don't exists 
                            if (!(is_dir($path))) {
                                mkdir($path);
                            }   
                            $filePath = $path . $fileName;
							$filePath = str_replace(" ", "_", $filePath);
                            $uploadDone = $SchachfibelDAO->uploadGruppenordnerFile($id, $filePath, $fileSize, $fileName);
                           if ($uploadDone && move_uploaded_file($_FILES["file"]["tmp_name"], $filePath)) {  
                ?>
			<div class="grupp">
				<p>
					Datei wurde hochgeladen
				</p>
			</div>
			<?php      } else { ?>
			<div class="grupp">
				<p>
					Datei konnte nicht hochgeladen werden.
				</p>
			</div>
			<?php      }
                        }
                    }
                }
                ?>
			<div class="button-box">
				<?php if (isset($_SESSION["loggedUserId"])) { ?>
				<div class="test">
					<form method="post" enctype="multipart/form-data">
						<div class="button-box-gruppenordner">
							<label class="button2" id="gruppenordner-inputlabel" for="gruppenordner-inputfile">
								<div class="button-pic">
									<img src="images/icons/folder-yellow.png" alt="Ordner"> &nbsp; Datei auswählen
								</div>
							</label>
							<input type="file" name="file" id="gruppenordner-inputfile" />
							<label for="gruppenordner-submitlabel" class="button2">
								<div class="button-pic">
									<img src="images/icons/upload-blue.png" alt="Hochladen">&nbsp; Datei hochladen
								</div>
							</label>
							<input type="submit" id="gruppenordner-submitlabel" value="Datei hochladen" />
							<input type="hidden" name="token" value="<?php echo $_SESSION["token"]; ?>" />
						</div>
					</form>
				</div>

				<?php } ?>
			</div>
		</div>

		<div class="table-gruppenordner">
			<table id="verzeichnistable">
				<tr>
					<th id="fileName" onclick="sortTable(0)">Name</th>
					<th id="fileAuthor" onclick="sortTable(1)">Autor*in</th>
					<th id="fileSize" onclick="sortTable(2)">Größe</th>
					<th id="fileDate" onclick="sortTable(3)">Datum</th>
					<th id="fileLike" onclick="sortTable(4)">Likes</th>
					<th class="gruppenordner-icon">Download</th>
					<?php if (isset($_SESSION["loggedUserId"])) { ?>
					<th class="gruppenordner-icon">Löschen</th>
					<?php } ?>
				</tr>
				<?php
                $gruppenordnerFiles = $SchachfibelDAO->getGruppenordnerFiles();
                if ($gruppenordnerFiles != null) {
                foreach ($gruppenordnerFiles as $index => $file) { ?>
				<tr>
					<?php
							$fileName = htmlspecialchars($file->getName());	
                            $userName = $SchachfibelDAO->getUser($file->getUserId())["name"];
                            if ($userName == null) {
                                echo "Fehler: User konnte nicht gefunden werden" . "<br>";
                            } else {
                                $userName = htmlspecialchars($userName);
                            }                    
							$userId = htmlspecialchars($file->getUserId());
							$fileSize = htmlspecialchars($file->getSize());
							$fileDate = htmlspecialchars($file->getDate());
							$fileId = htmlspecialchars($file->getFileId());
							$fileLikes = htmlspecialchars($SchachfibelDAO->getGruppenordnerFileLikes($fileId));
							$filePath = htmlspecialchars($file->getPath());
						?>
					<td data-sort-data="<?php echo $fileName; ?>"><?php echo $fileName; ?></td>
					<td data-sort-data="<?php echo $userName; ?>"><?php echo $userName; ?></td>
					<td data-sort-data="<?php echo Utils::convetStringToBytes($fileSize); ?>"><?php echo $fileSize; ?></td>
					<td data-sort-data="<?php echo strtotime($fileDate); ?>"><?php echo $fileDate; ?></td>
					<td data-sort-data="<?php echo $fileLikes; ?>">
						<form method="post">
							<div class="verzeichnistable-iconcolumn">
								<!-- like isset??? -->
								<?php
                                    if (isset($_SESSION["loggedUserId"]) && isset($_POST[$gruppenordnerNamespaceLike . $fileId . "_x"])
									   && isset($_SESSION["token"]) && isset($_POST["token"]) && $_SESSION["token"] == $_POST["token"]) {
                                        $SchachfibelDAO->likeGruppenordnerFile($fileId, $_SESSION["loggedUserId"]);
                                    }
                                    ?>
								<!-- like Herz -->
								<?php
                                    if (isset($_SESSION["loggedUserId"])) {
                                    ?>
								<input type="image" id="forumpost-like-<?php echo $fileId; ?>" name="<?php echo $gruppenordnerNamespaceLike . $fileId; ?>" src="
                                    <?php
                                        if ($SchachfibelDAO->hasUserLikedGruppenordnerFile($fileId, $_SESSION["loggedUserId"]) == 1) { ?>
                                                images/icons/herz.png
                                    <?php } else { ?>
                                                images/icons/herz-leer.png
                                    <?php } ?>" alt="Herz">
								<input type="hidden" name="token" value="<?php echo $_SESSION["token"]; ?>" />
								<?php } else { ?>
								<img src="images/icons/herz-leer.png" alt="Herz">
								<?php } ?>
								<!-- like number -->
								<div class="<?php
                                    if (isset($_SESSION["loggedUserId"]) && $SchachfibelDAO->hasUserLikedGruppenordnerFile($fileId, $_SESSION["loggedUserId"])) {
                                        echo "gruppenordner-likes-true";
                                    } else {
                                        echo "gruppenordner-likes-false";
                                    } ?>">
									<?php 
                                    $fileLikes = $SchachfibelDAO->getGruppenordnerFileLikes($fileId);
									$fileLikes = htmlspecialchars($fileLikes);
                                    if ($fileLikes == null) {
                                        $fileLikes = 0;
									}
                                    if (isset($_SESSION["loggedUserId"])) { ?>
									<label for="forumpost-like-<?php echo $fileId; ?>">
										<?php echo $fileLikes; ?>
									</label>
									<?php
                                    } else {
                                        echo $fileLikes;
                                    }
                                    ?>
								</div>
							</div>
						</form>
					</td>
					<td class="gruppenordner-icon"><a href="<?php echo $filePath; ?>" download>
							<img src="images/icons/download.png" alt="Download">
						</a>
					</td>
					<?php
                        if (isset($_SESSION["loggedUserId"]) || $id != 0) { ?>
					<td class="gruppenordner-icon">
						<form method="post">
							<?php if ($id == $userId) { ?>
							<input type="image" name="<?php echo $gruppenordnerNamespaceDelete . $fileId; ?>" alt="Mülleimer" src="images/icons/muelleimer.png">
							<input type="hidden" name="token" value="<?php echo $_SESSION["token"]; ?>" />
							<?php } ?>
						</form>
					</td>
					<?php } ?>
				</tr>
				<?php }
            } else {
            ?>
				<div class="grupp">
					<p>
						Es sind keine Gruppenordnerdateien vorhanden.
					</p>
				</div>
				<?php
            }
            ?>
			</table>
		</div>
	</div>
</div>

<script src="script/gruppenordner.js" async></script>

<?php include "php/footer.php"; ?>
