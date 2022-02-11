<?php
/**
 * Libreria de formularios de cada una de las tablas de la base de datos
 */
function ALL_muestra($cont = NULL) {
    if (is_null($cont)) {
        print <<<END
        <form name="newMuestra">
        	<label for="idijc">ID IJC</label><input type="text" id="idijc" name="idijc" autocomplete="off">
        	<label for="idpethema">ID PETHEMA</label><input type="text" id="idpethema" name="idpethema" autocomplete="off">
        	<label for="idsalamanca">ID Salamanca</label><input type="text" id="idsalamanca" name="idsalamanca" autocomplete="off">
        	<label for="inicials">Initials</label><input type="text" id="inicials" name="inicials" autocomplete="off">
        	<label for="sexe">Gender</label>
        	<select id="sexe" name="sexe">
        		<option value="--"></option>
        		<option value="Male">Male</option>
        		<option value="Female">Female</option>
        	</select>
        	<label for="edat">Age at diagnostic</label><input type="number" id="edat" name="edat" autocomplete="off">
        	<label for="hospital">Hospital</label><input type="text" id="hospital" name="hospital" autocomplete="off">
          <label for="metge">Clinician's contact name</label><input type="text" id="metge" name="metge" autocomplete="off">
        	<label for="mail">Clinician's contact email</label><input type="email" id="mail" name="mail" autocomplete="off">
        	<label for="protocol">Protocol</label><input type="text" id="protocol" name="protocol" autocomplete="off">
        	<label for="diagnostic">Diagnostic</label><input type="text" id="diagnostic" name="diagnostic" autocomplete="off">
        	<label for="datadiagnostic">Diagnostic date</label><input type="date" id="datadiagnostic" name="datadiagnostic" autocomplete="off">
        	<label for="consentiment">Informed consent?</label>
        	<select name="consentiment" id="consentiment">
        		<option value="--"></option>
        		<option value="Yes">Yes</option>
        		<option value="No">No</option>
        	</select>
          <label for="comentari">Additional comments</label>
          <textarea></textarea>
        	<div class="boton"><button type="submit">Save</button></div>
        </form>
END;
    }
    else {
        print "<form>";
        print '<label for="idijc">ID IJC</label><input type="text" id="idijc" name="idijc" autocomplete="off" value="' . $cont["ID_IJC"] . '" placeholder="Empty">';
        print '<label for="idpethema">ID PETHEMA</label><input type="text" id="idpethema" name="idpethema" autocomplete="off" value="' . $cont["ID_PETHEMA"] . '" placeholder="Empty">';
        print '<label for="idsalamanca">ID Salamanca</label><input type="text" id="idsalamanca" name="idsalamanca" autocomplete="off" value="' . $cont["ID_Salamanca"] . '" placeholder="Empty">';
        print '<label for="inicials">Initials</label><input type="text" id="inicials" name="inicials" autocomplete="off" value="' . $cont["Initials"] . '" placeholder="Empty">';
        print '<label for="sexe">Gender</label>';
        print '<select id="sexe" name="sexe">';
        print '<option value="--"></option>';
        if ($cont["Gender"] == "Man") {
            print '<option value="Man" selected>Man</option>';
            print '<option value="Woman">Woman</option>';
        }
        else if($cont["Gender"] == "Woman") {
            print '<option value="Man">Man</option>';
            print '<option value="Woman" selected>Woman</option>';
        }
        else {
            print '<option value="Man">Man</option>';
            print '<option value="Woman">Woman</option>';
        }
        print '</select>';
        print '<label for="edat">Age at diagnostic</label><input type="number" id="edat" name="edat" autocomplete="off" value="' . $cont["Age"] . '" placeholder="Empty">';
        print '<label for="hospital">Hospital</label><input type="text" id="hospital" name="hospital" autocomplete="off" value="' . $cont["Hospital"] . '" placeholder="Empty">';
        print '<label for="mail">Contact email</label><input type="email" id="mail" name="mail" autocomplete="off" value="' . $cont["Email"] . '" placeholder="Empty">';
        print '<label for="protocol">Protocol</label><input type="text" id="protocol" name="protocol" autocomplete="off" value="' . $cont["Protocol"] . '" placeholder="Empty">';
        print '<label for="diagnostic">Diagnostic</label><input type="text" id="diagnostic" name="diagnostic" autocomplete="off" value="' . $cont["Diagnostic"] . '" placeholder="Empty">';
        print '<label for="datadiagnostic">Diagnostic date</label><input type="date" id="datadiagnostic" name="datadiagnostic" autocomplete="off" value="' . $cont["DX_Date"] . '" placeholder="Empty">';
        print '<label for="consentiment">Informed consent?</label>';
        print '<select name="consentiment" id="consentiment">';
        print '<option value="--"></option>';
        if ($cont["CI"] == "Yes") {
            print '<option value="Yes" selected>Yes</option>';
            print '<option value="No">No</option>';
        }
        else if ($cont["CI"] == "No") {
            print '<option value="Yes">Yes</option>';
            print '<option value="No" selected>No</option>';
        }
        else {
            print '<option value="Yes">Yes</option>';
            print '<option value="No">No</option>';
        }
        print '</select>';
        print '<div class="dreta">Cryovials</div>';
        print '<div class="esquerra">';
        foreach ($cont["Cryovials"] as $c) {
            print '<p>+ <a href="crios.php?crioID=' . $c . '" title="More info">' . $c . '</a></p>';
        }
        print '<p>+ <a href="crios.php?sampID=' . $cont["ID_IJC"] . '">View all</a></p>';
        print '</div>';
        print '<div class="boton"><button type="button" onclick="atras()">Back</button></div>';
        print '<div class="boton"><button type="submit">Edit</button></div>';
        print "</form>";
    }
}

function ALL_cryo($cr = NULL) {
    if (is_null($cr)) {
        print <<<END
        <form>
            <fieldset id="cryo_general">
                <legend>Cryovial information</legend>
                <label for="idPacient">Sample IJC ID</label><input type="text" name="idPacient" id="idPacient" autocomplete="off">
                <label for="codiextern">Cryovial ID</label><input type="text" name="codiextern" id="codiextern" placeholder="Empty" autocomplete="off">
                <label for="data">Arrival date</label><input type="date" name="data" id="data" placeholder="Empty" autocomplete="off">
                <label for="origen">Origin</label><input type="text" name="origen" id="origen" placeholder="Empty" autocomplete="off">
                <label for="puntDX">Disease step</label><input type="text" name="puntDX" id="puntDX" placeholder="Empty" autocomplete="off">
                <label for="teixit">Tissue origin</label><input type="text" name="teixit" id="teixit" placeholder="Empty" autocomplete="off">
                <label for="percentBlasts">Blasts percent</label><input type="number" name="percentBlasts" id="percentBlasts" placeholder="Empty" autocomplete="off">
                <label for="celsDisponibles">Number of frozen cells</label><input type="number" name="celsDisponibles" id="celsDisponibles" placeholder="Emtpy" autocomplete="off">
                <label for="disponible">Available</label><select name="disponible" id="disponible">
                    <option value="" selected></option>
                    <option value="Yes">Yes</option>
                    <option values="No">No</option>
                </select>
                <label for="comentaris">Additional comments</label><textarea name="comentaris" id="comentaris"></textarea>
            </fieldset>
            <fieldset id="cryo_storage">
                <legend>Cryovial storage</legend>
                <label for="guardatEn">Stored in</label><select name="guardatEn" id="guardatEn">
                    <option value="" selected></option>
                    <option value="IGTP">IGTP</option>
                    <option value="IJC">IJC</option>
                </select>
                <label for="tanc">Tank storage</label><input type="text" name="tanc" id="tanc" placeholder="Empty" autocomplete="off">
                <label for="rac">Rack storage</label><input type="text" name="rac" id="rac" placeholder="Empty" autocomplete="off">
                <label for="caixa">Box</label><input type="text" name="caixa" id="caixa" placeholder="Empty" autocomplete="off">
                <label for="posicio">Position</label><input type="text" name="posicio" id="posicio" placeholder="Empty" autocomplete="off">
            </fieldset>
            <fieldset id="cryo_thaw">
            <legend>Thaw</legend>
                <label for="dataDesco">Defrost date</label><input type="date" name="dataDesco" id="dataDesco" placeholder="Empty" autocomplete="off">
                <label for="motiuDesco">Defrost reason</label><input type="text" name="motiuDesco" id="motiuDesco" placeholder="Empty" autocomplete="off">
                <label for="celsDesco">Number of recovered cells</label><input type="number" id="celsDesco" name="celsDesco" placeholder="Empty" autocomplete="off">
                <label for="sorting">Sorting markers</label><input type="text" name="sorting" id="sorting" placeholder="Empty" autocomplete="off">
                <!--<label for="sortingPop">Sorting population</label><input type="text" name="sortingPop" id="sortingPop" placeholder="Empty" autocomplete="off">-->
                <label for="commentsThaw">Additional comments</label><textarea name="commentsThaw" id="commentsThaw"></textarea>
            </fieldset>
            <div class="boton"><button type="submit">Save</button></div>
        </form>
END;
    }
    else {
      //TODO Canviar l'estructura d'aquest formulari
        print "<form>";
        print '<label for="codiextern">External code</label><input type="text" name="codiextern" id="codiextern" placeholder="Empty" autocomplete="off" value="' . $cr["ID"] . '">';
        print '<label for="data">Date</label><input type="date" name="data" id="data" placeholder="Empty" autocomplete="off" value="' . $cr["Date"] . '">';
        print '<label for="origen">Origin</label><input type="text" name="origen" id="origen" placeholder="Empty" autocomplete="off" value="' . $cr["Origin"]. '">';
        print '<label for="puntDX">Disease step</label><input type="text" name="puntDX" id="puntDX" placeholder="Empty" autocomplete="off" value="' . $cr["Disease_step"] . '">';
        print '<label for="teixit">Tissue</label><input type="text" name="teixit" id="teixit" placeholder="Empty" autocomplete="off" value="' . $cr["Tissue"] . '">';
        print '<label for="percentBlasts">Blasts percent</label><input type="number" name="percentBlasts" id="percentBlasts" placeholder="Empty" autocomplete="off" value="' . $cr["Blast_perc."] . '">';
        print '<label for="guardatEn">Stored in</label><input type="text" name="guardatEn" id="guardatEn" placeholder="Empty" autocomplete="off" value="' . $cr["Stored_in"] . '">';
        print '<label for="dataDesco">Defrost date</label><input type="date" name="dataDesco" id="dataDesco" placeholder="Empty" autocomplete="off" value="' . $cr["Defrost_date"] . '">';
        print '<label for="motiuDesco">Defrost reason</label><input type="text" name="motiuDesco" id="motiuDesco" placeholder="Empty" autocomplete="off" value="' . $cr["Defrost_reas."] . '">';
        print '<label for="viabilitat">Availability</label><input type="text" name="viabilitat" id="viabilitat" placeholder="Empty" autocomplete="off" value="' . $cr["Availability"] . '">';
        print '<label for="sorting">Sorting</label><input type="text" name="sorting" id="sorting" placeholder="Empty" autocomplete="off" value="' . $cr["Sorting"] . '">';
        print '<label for="sortingPop">Sorting population</label><input type="text" name="sortingPop" id="sortingPop" placeholder="Empty" autocomplete="off" value="' . $cr["Sort.Pop."] . '">';
        print '<label for="comentari">Additional comments</label><textarea name="comentari" id="comentari">' . $cr["Comment"] . '</textarea>';
        print '<label for="idPacient">Patient ID</label><select name="idPacient" id="idPacient">';
        print '<option value="' . $cr["Pat.ID"] . '" selected>' . $cr["Pat.ID"] . "</option>";
        print '</select>';
        print '<label for="refrozen">Refrozen</label><input type="text">';
        print '<label for="mice">Mice</label><input type="text">';
        print '<div class="boton"><button type="submit">Edit</button></div>';
        print  '</form>';
    }
}

function ALL_dna($dna = NULL) {
    // Formulario vacio
    if (is_null($dna)) {
        print <<<END
        <form>
            <label for="idijc">IJC ID</label><input type="text" name="idijc" id="idijc" placeholder="Internal ID" autocomplete="off">
            <label for="idext">External ID</label><input type="text" name="idext" id="idext" placeholder="External ID" autocomplete="off">
            <label for="data">Arrival/extraction date</label><input type="date" name="data" id="data" autocomplete="off">
            <label for="origen">Origin</label><input type="text" name="origen" id="origen" placeholder="DNA origin" autocomplete="off">
            <label for="puntDX">Disease step</label><input type="text" name="puntDX" id="puntDX" placeholder="" autocomplete="off">
            <label for="teixit">Tissue</label><input type="text" id="teixit" name="teixit" placeholder="" autocomplete="off">
            <label for="percentBlasts">Blasts percent</label><input type="number" name="percentBlasts" id="percentBlasts" placeholder="" autocomplete="off">
            <label for="tipusExtraccio">Type of extraction</label><input type="text" name="tipusExtraccio" id="tipusExtraccio" placeholder="" autocomplete="off">
            <label for="nanodrop">Nanodrop</label><input type="text" name="nanodrop" id="nanodrop" placeholder="" autocomplete="off">
            <label for="ratio280">Ratio 260/280</label><input type="number" name="ratio280" id="ratio280" placeholder="" autocomplete="off">
            <label for="ratio230">Ratio 260/230</label><input type="number" name="ratio230" id="ratio230" placeholder="" autocomplete="off">
            <label for="abs320">Abs 320</label><input type="number" name="abs320" id="abs320" placeholder="" autocomplete="off">
            <label for="qbit">Qbit</label><input type="text" name="qbit" id="qbit" placeholder="" autocomplete="off">
            <label for="tape">Tape</label><input type="text" name="tape" id="tape" placeholder="" autocomplete="off">
            <label for="volum">Volume</label><input type="text" name="volum" id="volum" placeholder="" autocomplete="off">
            <label for="comentari">Additional comments</label><textarea name="comentari" id="comentari"></textarea>
            <div class="boton"><button type="submit">Save</button></div>
        </form>
END;
    }
    else {
        //Formulario completado con un dna para editar
        print "Pending to DO";
    }
}

function ALL_rna($rna = NULL) {
    // Formulario vacio
    if (is_null($rna)) {
        print <<<END
            <form>
                <label for="idijc">IJC ID</label><input type="text" name="idijc" id="idijc" placeholder="Internal ID" autocomplete="off">
                <label for="idext">External ID</label><input type="text" name="idext" id="idext" placeholder="External ID" autocomplete="off">
                <label for="data">Arrival/extraction date</label><input type="date" name="data" id="data" autocomplete="off">
                <label for="origen">Origin</label><input type="text" name="origen" id="origen" placeholder="DNA origin" autocomplete="off">
                <label for="puntDX">Disease step</label><input type="text" name="puntDX" id="puntDX" placeholder="" autocomplete="off">
                <label for="teixit">Tissue</label><input type="text" id="teixit" name="teixit" placeholder="" autocomplete="off">
                <label for="percentBlasts">Blasts percent</label><input type="number" name="percentBlasts" id="percentBlasts" placeholder="" autocomplete="off">
                <label for="nanodrop">Nanodrop</label><input type="text" name="nanodrop" id="nanodrop" placeholder="" autocomplete="off">
                <label for="ratio280">Ratio 260/280</label><input type="number" name="ratio280" id="ratio280" placeholder="" autocomplete="off">
                <label for="ratio230">Ratio 260/230</label><input type="number" name="ratio230" id="ratio230" placeholder="" autocomplete="off">
                <label for="abs320">Abs 320</label><input type="number" name="abs320" id="abs320" placeholder="" autocomplete="off">
                <label for="qbit">Qbit</label><input type="text" name="qbit" id="qbit" placeholder="" autocomplete="off">
                <label for="tape">Tape</label><input type="text" name="tape" id="tape" placeholder="" autocomplete="off">
                <label for="volum">Volume</label><input type="text" name="volum" id="volum" placeholder="" autocomplete="off">
                <label for="comentari">Additional comments</label><textarea name="comentari" id="comentari"></textarea>
                <div class="boton"><button type="submit">Save</button></div>
            </form>
END;
    }
    else {
        //Formulario completado con un dna para editar
        print "Pending to DO";
    }
}

function ALL_saliva($saliva = NULL) {
    // Formulario vacio para nueva saliva
    if (is_null($saliva)) {
        print <<<END
            <form>
                <label for="idijc">ID IJC</label><input type="text" name="idijc" id="idijc" placeholder="Internal ID" autocomplete="off">
                <label for="data">Date</label><input type="date" name="data" id="data" placeholder="Arrival date" autocomplete="off">
                <label for="origen">Origin</label><input type="text" name="origen" id="origen" placeholder="" autocomplete="off">
                <label for="extraccio">Extraction type</label><input type="text" name="extraccio" id="extraccio" placeholder="" autocomplete="off">
                <label for="dataDesco">Thaw date</label><input type="date" name="dataDesco" id="dataDesco" placeholder="" autocomplete="off">
                <label for="guardatEn">Stored in</label><input type="text" name="guardatEn" id="guardatEn" placeholder="" autocomplete="off">
                <label for="comentaris">Additional comments</label><textarea name="comentaris" id="comentaris"></textarea>
                <div class="boton"><button type="submit">Save</button></div>
            </form>
END;
    }
    else {
        // Formulario completado para editar una saliva ya existente
        print "Pending to create the form";
    }
}

function ALL_other($other = NULL) {
    //Formulario vacio para nueva entrada
    if (is_null($other)) {
        print <<<END
            <form>
                <label for="idijc">ID IJC</label><input type="text" name="idijc" placeholder="Internal ID" autocomplete="off">
                <label for="tipusMostra">Sample type</label><input type="text" name="tipusMostra" id="tipusMostra" placeholder="" autocomplete="off">
                <label for="guardatEn">Stored in</label><input type="text" name="guardatEn" id="guardatEn" placeholder="" autocomplete="off">
                <label for="comentaris">Additional comments</label><textarea name="comentaris" id="comentaris"></textarea>
                <div class="boton"><button type="submit">Save</button></div>
            </form>
END;
    }
    else {
        print "SORRY, UNDER CONSTRUCTION";
    }
}
?>
