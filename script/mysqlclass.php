<?php

class db {

//Remote database settings
//    var $hostname = "dbosfacdmtdev.db.8487892.hostedresource.com";
//    var $databasename = "dbosfacdmtdev";
//    var $username = "dbosfacdmtdev";
//    var $password = "Osf@cL@b01";
//    Local database settings
    var $hostname = "localhost";
    var $databasename = "dbosfacdmt";
    var $username = "root";
    var $password = "ustopudie";
    //
    var $query_id = 0; // identifiant de resultat
    var $link_id = 0; // identifiant de connexion
    var $error = ""; // description de la derniere erreur
    var $record = array(); // tableau contenant l'enregistrement courant
    var $row = 0;  // compteur de ligne (la ligne courante du recordset)
    var $auto_free = 0; // a 1 si on libere automatiquement la memoire apres certaines fonctions
    var $lastinsertedid;

    // methodes 
    // le constructeur choisi uniquement si on veut liberer ou pas la memoire

    function db($autofree) {
        $this->auto_free = $autofree;
    }

    // ouvre une connexion persistante et se connecte a la base desiree
    function connect() {
        // ouverture de la connexion persistante
        if (($this->link_id = mysql_pconnect($this->hostname, $this->username, $this->password)) == false) {
            $this->error = "Impossible to create a persistent connection !";
            return(0);
        }
        // selection de la base

        if (mysql_select_db($this->databasename, $this->link_id) == false) {
            $this->error = "Impossible to check the database !";
            return(0);
        }
        return($this->link_id);
    }

    // pour liberer la memoire de la derniere requete

    function free() {
        if (mysql_free_result($this->query_id) == false) {
            $this->error = "Erreur lors de la tentative de libération de memoire";
        }
        $this->query_id = 0;
    }

    // pour lancer une requete sur la connexion courante

    function query($query = "") {
        $rtval = 0;
        // pour tester si il existe une connexion
        if ($this->link_id != 0) {
            // test si on doit liberer la memoire
            if ($this->query_id != 0 && $this->auto_free == 1) {
                $this->free();
            }
            if (($this->query_id = mysql_query($query, $this->link_id)) == false) {
                $this->error = "Impossible to launch the query";
            } else {
                $this->lastinsertedid = mysql_insert_id();
                $rtval = $this->query_id;
                $this->row = 0;
            }
        } else {
            $this->error = "Impossible de lancer une requête, il n'existe pas de connexion !";
        }
        return($rtval);
    }

    // pour avancer d'un element dans le resultset
    function next_record() {
        $rtval = 0;
        if ($this->query_id != -1) { // si il y a un index de resultat
            $this->record = mysql_fetch_array($this->query_id);
            $this->row = $this->row + 1;
            // test validite
            $stat = is_array($this->record);
            if (!$stat && $this->auto_free) {
                $this->free();
            }
            if ($stat) {
                $rtval = 1;
            }
        } else {
            $this->error = "Impossible d'avancer le résultat, pas d'id de res !";
        }

        return($rtval);
    }

    // pour positionner le pointeur interne du resultset a l'endroit desire
    function seek($pos = 0) {
        $rtval = -1;
        if (mysql_data_seek($this->query_id, $pos) != false) {
            $this->row = $pos;
            $rtval = $pos;
        }
        return($rtval);
    }

    // retourne le nombre de lignes dans le recordset
    // (uniquement apres un select)
    function num_rows() {
        return(mysql_num_rows($this->query_id));
    }

    // retourne le nombre de champs de l'enregistrement courant
    function num_fields() {
        return(mysql_num_fields($this->query_id));
    }

    // retourne le nombre de tuples affectes
    // (nb de lignes affectees apres un insert, update ou delete)
    // (!!! : si on fait un delete sur ts les enregistrements -> sans clause where
    // alors la fonction renvoie 0)
    function affected_rows() {
        return(mysql_affected_rows($this->link_id));
    }

    //\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\
    //\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\
    // retourne l'element desire (indice ou nom du champ) de la ligne courante
    function f($col) {
        return($this->record[$col]);
    }

    // pour afficher l'elemnt desire de la ligne courante
    function p($col) {
        print $this->record[$col];
    }

    // alias de num_rows()
    function nf() {
        return($this->num_rows());
    }

    // pour afficher le resultat de num_rows()
    function np() {
        print $this->num_rows();
    }

}
