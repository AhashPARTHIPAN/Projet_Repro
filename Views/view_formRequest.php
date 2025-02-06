<?php include "view_begin_enseignant.php"; ?>

<section>

    <h1>Demande d'impression</h1>

    <em class="obligatoire" style="font-size: 15px; opacity: 0.9">Les champs obligatoires sont indiqués avec *</em><br><br>

    <form action="?controller=update&action=form_demande" method="POST">
        <!-- Saisit du département si différent de celui de base -->
        <div class="space">
            <label>Département <span class="obligatoire">*</span></label>
            <?php foreach ($data["departements"] as $dept): ?>
                <label class="radio-flex"><input type="radio" name="departement" value="<?= $dept["nom"]; ?>" required><?= $dept["nom"]; ?></label>
            <?php endforeach; ?>
        </div>
        

        <!-- NOMBRE DE PAGES -->
        <div class="space">
            <label>Nombre de pages <span class="obligatoire">*</span></label>
            <label><input type="number" name="nb_pages" min="1" value="1" required ></label>
        </div>

        <!-- NOMBRE DE COPIES -->
        <div class="space">
            <label>Nombre de copies <span class="obligatoire">*</span></label>
            <label><input type="number" name="nb_copies" min="1" value="1" required ></label>
        </div>

        <!-- TYPES DE BROCHURE -->
        <div class="space">
            <label>Types de brochure <span class="obligatoire">*</span></label>
            <?php foreach ($data["typesBrochures"] as $type_brochure): ?>
                <label class="radio-flex"><input type="radio" name="typeBrochure" value="<?= $type_brochure["nomBrochure"]; ?>" class="type-brochure" required ><?= $type_brochure["nomBrochure"]; ?></label>
            <?php endforeach; ?>
        </div>

        <!-- FORMAT -->
        <div class="space">
            <label>Format <span class="obligatoire">*</span></label>
            <label class="radio-flex">
            <select name="format" id="format"
            required >
                <option value="A3">A3</option>
                <option value="A4">A4</option>
                <option value="A5">A5</option>
            </select>
            </label>
        </div>

        <!-- AGRAFE -->
        <div class="space">
            <label>Agrafe <span class="obligatoire">*</span></label>
            <label class="radio-flex"><input type="radio" name="agrafe" value="1" required >Oui</label>
            <label class="radio-flex"><input type="radio" name="agrafe" value="0" required >Non</label>
        </div>

        <div class="space">
            <!-- COUVERTURE -->
            <div>
                <label class="radio-flex">Couverture </label>
                <label for="couverture_check" class="radio-flex">
                    <input type="checkbox" id="couverture_oui" name="couverture">
                </label>
            </div>

            <!-- COUVERTURE DE DEBUT -->
            <div class="couv" style="display: none;">
                <label class="radio-flex">Couverture de début</label>
                <label for="couverture_debut_check" class="radio-flex">
                    <input type="checkbox" id="couv_debut" name="couverture_debut">
                </label>
            </div>

            <!-- COULEUR DE COUVERTURE DE DEBUT -->
            <div id="coul_couv_debut" style="display: none;">
                <label for="color" class="radio-flex">Choisir une couleur pour la couverture de début:</label>
                <input type="color" name="colorDebut" id="color" class="radio-flex" disabled/>
            </div>

            <!-- COUVERTURE DE FIN -->
            <div class="couv" style="display: none;">
                <label class="radio-flex">Couverture de fin</label>
                <label for="couverture_fin_check" class="radio-flex">
                    <input type="checkbox" id="couv_fin" name="couverture_fin">
                </label>
            </div>

            <!-- COULEUR DE COUVERTURE DE FIN -->
            <div id="coul_couv_fin" style="display: none;">
                <label for="colorFin" class="radio-flex">Choisir une couleur de couverture de fin:</label>
                <input type="color" name="colorFin" id="colorFin" class="radio-flex" disabled>
            </div>
        </div>

        <!-- NOMBRE DE PAGES PAR FEUILLE -->
        <div class="space">
            <label for="nb_pages_par_feuille">Nombre de pages par feuille <span class="obligatoire">*</span></label>
            <select name="nb_pages_par_feuille" id="nb_pages_par_feuille" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
        </div>

        <div class="space">
            <!-- FINITION MULTIPLE -->
            <div>
                <label for="finition_multiple" class="radio-flex">Finition multiple</label>
                <input type="checkbox" id="finition_multiple_check" name="finition_multiple">
            </div>


            <!-- CHOIX FINITION MULTIPLE -->
            <div id="finition_multiple_choix" style="display: none;">
                <label for="pliage" class="radio-flex">
                    <input type="radio" name="type_finition" value="pliage"> Pliage
                </label>

                <label for="creation_cahier" class="radio-flex">
                    <input type="radio" name="type_finition" value="crea_cahier"> Création cahier
                </label>

                <label for="perforation" class="radio-flex">
                    <input type="checkbox" name="type_finition" value="perforation" id="perforation_radio" > Perforation
                </label>

                <div class="type_perforation"  style="display: none;">
                    <label for="2trous" class="radio-flex">
                        <input type="radio" name="type_perforation" value="2trous"> 2 trous
                    </label>

                    <label for="3trous" class="radio-flex">
                        <input type="radio" name="type_perforation" value="3trous"> 3 trous
                    </label>
                </div>
            </div>
        </div>

        <!-- POUR LE [date] -->
        <div class="space">
            <label>Pour le <span class="obligatoire">*</span></label>
            <label><input type="date" name="date_livraison" id="date_livraison" required ></label>
        </div>

        <!-- FICHIER -->
        <div class="space">
            <label>Fichier <span class="obligatoire">*</span></label>
            <label>
                <input type="file" name="fichier" id="fileInput" accept=".pdf,.ps,.pcl,.docx" required>
            </label>
            <em><p class="file-note" style="opacity: 0.8; font-size: 15px;">Formats autorisés: .pdf, .ps, .pcl, .docx<br>Taille maximum autorisée: 200 Mo</p></em>
        </div>
        

        <!-- COMMENTAIRE OPTIONNEL -->
        <div class="space">
            <label>Commentaires (si nécessaire)</label>
            <label><textarea name="commentaire" id="commentaire" placeholder="Écrire ici ..."></textarea></label>
        </div>

        <!-- BOUTON ENVOYER -->
        <div class="space">
            <button>Envoyer la demande</button>
        </div>
    </form>
</section>

<script src="ScriptJS/script_formRequest.js"></script>

<?php require "view_end"; ?>
