<?php include "view_begin.php"; ?>

<section>

    <h1>Demande d'impression</h1>

    <em class="obligatoire" style="font-size: 15px; opacity: 0.9">Les champs obligatoires sont indiqués avec *</em><br><br>

    <form action="?controller=demande&action=form_demande" method="POST" enctype="multipart/form-data">
        <!-- Saisit du département si différent de celui de base -->
        <div>
            <label>Département <span class="obligatoire">*</span></label>
            <?php foreach ($data["departements"] as $dept): ?>
                <label class="radio-flex"><input type="radio" name="departement" value="<?= $dept["nom"]; ?>" required><?= $dept["nom"]; ?></label>
            <?php endforeach; ?>
        </div>

        <div>
            <label>Examen <span class="obligatoire">*</span></label>
            <label for="examen_oui" class="radio-flex"><input type="radio" id="examen_oui" name="examen" value="1" required>Oui</label>
            <label for="examen_non" class="radio-flex"><input type="radio" id="examen_non" name="examen" value="0" required>Non</label>
        </div>
        

        <!-- NOMBRE DE PAGES -->
        <div>
            <label>Nombre de pages <span class="obligatoire">*</span></label>
            <label><input type="number" name="nb_pages" min="1" value="1" required ></label>
        </div>

        <!-- NOMBRE DE COPIES -->
        <div>
            <label>Nombre de copies <span class="obligatoire">*</span></label>
            <label><input type="number" name="nb_copies" min="1" value="1" required ></label>
        </div>

        <!-- TYPES DE BROCHURE -->
        <div>
            <label>Types de brochure <span class="obligatoire">*</span></label>
            <?php foreach ($data["typesBrochures"] as $type_brochure): ?>
                <label class="radio-flex type-brochure"><input type="radio" name="typeBrochure" value="<?= $type_brochure["nomBrochure"]; ?>" required ><?= $type_brochure["nomBrochure"]; ?></label>
            <?php endforeach; ?>
        </div>

        <!-- FORMAT -->
        <div>
            <label>Format <span class="obligatoire">*</span></label>
            <label class="radio-flex">
            <select name="format" id="format"
            required >
                <option value="A4">A4</option>
                <option value="A3">A3</option>
            </select>
            </label>
        </div>

        <!-- AGRAFE -->
        <div>
            <label>Agrafe <span class="obligatoire">*</span></label>
            <label class="radio-flex"><input type="radio" name="agrafe" value="1" required >Oui</label>
            <label class="radio-flex"><input type="radio" name="agrafe" value="0" required >Non</label>
        </div>

        <!-- NOMBRE DE PAGES PAR FEUILLE -->
        <div>
            <label for="nb_pages_par_feuille">Nombre de pages par feuille <span class="obligatoire">*</span></label>
            <select name="nb_pages_par_feuille" id="nb_pages_par_feuille" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
        </div>

        <!-- POUR LE [date] -->
        <div>
            <label>Pour le <span class="obligatoire">*</span></label>
            <label><input type="date" name="date_livraison" id="date_livraison" required ></label>
        </div>

        <!-- COUVERTURE -->
        <div>
            <label class="radio-flex">Couverture </label>
            <label for="couverture_check" class="radio-flex">
                <input type="checkbox" id="couverture_oui" name="couverture">
            </label>

            <!-- COUVERTURE DE DEBUT -->
            <div class="couv" style="display: none;">
                <label class="radio-flex">Couverture de début</label>
                <label for="couverture_debut_check" class="radio-flex">
                    <input type="checkbox" id="couv_debut" name="couverture_debut">
                </label>

                <!-- COULEUR DE COUVERTURE DE DEBUT -->
                <div id="coul_couv_debut" style="display: none;">
                    <label for="color" class="radio-flex">Choisir une couleur pour la couverture de début:</label>
                    <input type="color" name="colorDebut" id="color" class="radio-flex"/>
                </div>
            </div>

            <!-- COUVERTURE DE FIN -->
            <div class="couv" style="display: none;">
                <label class="radio-flex">Couverture de fin</label>
                <label for="couverture_fin_check" class="radio-flex">
                    <input type="checkbox" id="couv_fin" name="couverture_fin">
                </label>

                <!-- COULEUR DE COUVERTURE DE FIN -->
                <div id="coul_couv_fin" style="display: none;">
                    <label for="colorFin" class="radio-flex">Choisir une couleur de couverture de fin:</label>
                    <input type="color" name="colorFin" id="colorFin" class="radio-flex">
                </div>
            </div>
        </div>

        <div>
            <!-- FINITION MULTIPLE -->
            <div>
                <label for="finition_multiple" class="radio-flex">Finition multiple</label>
                <input type="checkbox" id="finition_multiple_check" name="finition_multiple">

                <!-- CHOIX FINITION MULTIPLE -->
                <div id="finition_multiple_choix" style="display: none;">
                    <label for="pliage" class="radio-flex">
                        <input type="radio" id="pliage" name="type_finition" value="pliage"> Pliage
                    </label>

                    <label for="crea_cahier" class="radio-flex">
                        <input type="radio" id="crea_cahier" name="type_finition" value="crea_cahier"> Création cahier
                    </label>

                    <label for="perforation_radio">
                        <input type="radio" name="type_finition" value="perforation" id="perforation_radio" > Perforation
                    </label>

                    <label for="trous2" class="radio-flex type_perforation" style="display: none;">
                            <input type="radio" id="trous2" name="type_perforation" value="trous2"> 2 trous
                        </label>

                    <label for="trous3" class="radio-flex type_perforation" style="display: none;">
                        <input type="radio" id="trous3" name="type_perforation" value="trous3"> 3 trous
                    </label>
                </div>
            </div>
        </div>

        <!-- FICHIER -->
        <div>
            <label>Fichier <span class="obligatoire">*</span></label>
            <label>
                <input type="file" name="fichier" id="fileInput" accept=".pdf,.ps,.pcl,.docx" required>
            </label>
            <em><p class="file-note" style="opacity: 0.8; font-size: 15px;">Formats autorisés: .pdf, .ps, .pcl, .docx: attention, risque de mauvais impression<br>Taille maximum autorisée: 200 Mo</p></em>
        </div>
        

        <!-- COMMENTAIRE OPTIONNEL -->
        <div>
            <label>Commentaires (si nécessaire)</label>
            <label><textarea name="commentaire" id="commentaire" placeholder="Écrire ici ..."></textarea></label>
        </div>

        <!-- BOUTON ENVOYER -->
        <div>
            <button class="button">Envoyer la demande</button>
        </div>
    </form>
</section>

<script src="ScriptJS/script_formRequest.js"></script>

<?php require "view_end"; ?>
