<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * xmnews module
 *
 * @copyright       XOOPS Project (https://xoops.org)
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @author          Mage Gregory (AKA Mage)
 */

// Button
define('_MA_XMNEWS_CATEGORY_ADD', 'Ajout d\'une catégorie');
define('_MA_XMNEWS_CATEGORY_LIST', 'Liste des catégories');
define('_MA_XMNEWS_NEWS_ADD', 'Ajout d\'un article');
define('_MA_XMNEWS_NEWS_LIST', 'Liste des articles');
define('_MA_XMNEWS_REDIRECT_SAVE', 'Enregistré avec succès');
 
// Admin
define('_MA_XMNEWS_INDEXCONFIG_XMDOC_WARNINGNOTINSTALLED', 'Vous n\'avez pas installé le module xmdoc, ce module est requis si vous souhaitez ajouter des documents aux articles');
define('_MA_XMNEWS_INDEXCONFIG_XMDOC_WARNINGNOTACTIVATE', 'Vous devez activer dans les préférences du module xmnews l\'utilisation de xmdoc (si vous souhaitez ajouter des documents)');
 
// Error message
define('_MA_XMNEWS_ERROR', 'Erreur');
define('_MA_XMNEWS_ERROR_NACTIVE', 'Erreur : Contenu désactivé!');
define('_MA_XMNEWS_ERROR_NOACESSCATEGORY', 'Vous n\'avez accès à aucune catégorie');
define('_MA_XMNEWS_ERROR_NOCATEGORY', 'Il n\'y a pas de catégories dans la base de données');
define('_MA_XMNEWS_ERROR_NONEWS', 'Il n\'y a pas d\'article dans la base de données');
define('_MA_XMNEWS_ERROR_NPUBLISHED', 'Cet article n\'est pas encore publié');
define('_MA_XMNEWS_ERROR_SIZE', "La taille dans les préférences du module (taille maximale des fichiers téléchargés) dépasse les valeurs maximales définies dans 'post_max_size' ou 'upload_max_filesize' dans la configuration du fichier php.ini.");
define('_MA_XMNEWS_ERROR_WEIGHT', 'Le poids doit être un nombre');

// Info message
define('_MA_XMNEWS_INFO_NEWSDISABLE', 'L\'article est désactivé, vous le voyez car vous êtes autorisé à modifier son statut.');
define('_MA_XMNEWS_INFO_NEWSWAITING', 'L\'article est en attente de validation, vous le voyez car vous êtes autorisé à modifier son statut');
define('_MA_XMNEWS_INFO_NEWSNOTPUBLISHED', 'L\'article n\'est pas encore publié (la date de publication est plus élevée que la date actuelle), vous le voyez car vous êtes autorisé à modifier sa date de publiation');

// Shared
define('_MA_XMNEWS_ACTION', 'Action');
define('_MA_XMNEWS_ADD', 'Ajout');
define('_MA_XMNEWS_CLONE', 'Cloner');
define('_MA_XMNEWS_DEL', 'Effacer');
define('_MA_XMNEWS_EDIT', 'Modifier');
define('_MA_XMNEWS_STATUS', 'Statut');
define('_MA_XMNEWS_STATUS_A', 'Activé');
define('_MA_XMNEWS_STATUS_NA', 'Désactivé');
define('_MA_XMNEWS_VIEW', 'Afficher');

//Index
define('_MA_XMNEWS_INDEX_IMAGEINFO', 'Statut du serveur');
define('_MA_XMNEWS_INDEX_SPHPINI', "<span style='font-weight: bold;'>Informations extraites du fichier php.ini:</span>");
define('_MA_XMNEWS_INDEX_ON', "<span style='font-weight: bold;'>ON</span>");
define('_MA_XMNEWS_INDEX_OFF', "<span style='font-weight: bold;'>OFF</span>");
define('_MA_XMNEWS_INDEX_SERVERUPLOADSTATUS', 'Statut d\'envoi du serveur : ');
define('_MA_XMNEWS_INDEX_MAXPOSTSIZE', 'Taille d\'envoi maximal autorisé (directive post_max_size dans php.ini): ');
define('_MA_XMNEWS_INDEX_MAXUPLOADSIZE', 'Taille d\'envoi maximal autorisé (directive upload_max_filesize dans le fichier php.ini): ');
define('_MA_XMNEWS_INDEX_MEMORYLIMIT', 'Limite de mémoire (directive memory_limit dans php.ini): ');
define('_MA_XMNEWS_INDEXCONFIG_XMSOCIAL_WARNINGNOTINSTALLED', 'Vous n\'avez pas installé le module xmsocial, ce module est requis si vous souhaitez évaluer les articles');
define('_MA_XMNEWS_INDEXCONFIG_XMSOCIAL_WARNINGNOTACTIVATE', 'Vous devez activer dans les préférences du module xmnews l\'utilisation de xmsocial (si vous souhaitez évaluer les articles)');

// Category
define('_MA_XMNEWS_CATEGORY_DESC', 'Description');
define('_MA_XMNEWS_CATEGORY_DOCOMMENT', 'Afficher les commentaires');
define('_MA_XMNEWS_CATEGORY_DODSC', 'Valeur par défaut pour les nouveaux articles dans cette catégorie');
define('_MA_XMNEWS_CATEGORY_DODATE', 'Afficher la date');
define('_MA_XMNEWS_CATEGORY_DOHITS', 'Afficher les lectures');
define('_MA_XMNEWS_CATEGORY_DOMDATE', 'Afficher la date de modification');
define('_MA_XMNEWS_CATEGORY_DORATING', 'Afficher l\'évaluation');
define('_MA_XMNEWS_CATEGORY_DOUSER', 'Afficher l\'auteur');
define('_MA_XMNEWS_CATEGORY_EMPTY', 'Vide');
define('_MA_XMNEWS_CATEGORY_FORMPATH', 'Les fichiers sont dans : %s');
define('_MA_XMNEWS_CATEGORY_LOGO', 'Logo de la catégorie');
define('_MA_XMNEWS_CATEGORY_LOGOFILE', 'Fichier de logo');
define('_MA_XMNEWS_CATEGORY_NAME', 'Nom');
define('_MA_XMNEWS_CATEGORY_SUREDEL', 'Êtes-vous sûr de vouloir supprimer cette catégorie? %s');
define('_MA_XMNEWS_CATEGORY_THEREARENEWS', 'Il y a <strong>%s</strong> articles dans cette catégorie!');
define('_MA_XMNEWS_CATEGORY_UPLOAD', 'Upload');
define('_MA_XMNEWS_CATEGORY_UPLOADSIZE', 'Taille maximum : %s Kb');
define('_MA_XMNEWS_CATEGORY_WARNINGDELNEWS', '<strong>Attention, les éléments suivants seront également supprimés!</strong>');
define('_MA_XMNEWS_CATEGORY_WEIGHT', 'Poids');

// News
define('_MA_XMNEWS_CLONE_NAME', 'CLONE');
define('_MA_XMNEWS_NEWS_CATEGORY', 'Categorie');
define('_MA_XMNEWS_NEWS_AUTHOR', 'Auteur');
define('_MA_XMNEWS_NEWS_DATE', 'Date de publication');
define('_MA_XMNEWS_NEWS_DATEUPDATE', 'Mise à jour de la date de publication');
define('_MA_XMNEWS_NEWS_DESC', 'Résumé');
define('_MA_XMNEWS_GENINFORMATION', 'Informations générales');
define('_MA_XMNEWS_NEWS_KEYWORD', 'Meta keywords');
define('_MA_XMNEWS_NEWS_KEYWORD_DSC', 'La balise méta keywords est une série de mots clés qui représentent le contenu de vos actualités. Tapez des mots-clés séparés par une virgule. (Ex. XOOPS, PHP, MySQL, système de portail)');
define('_MA_XMNEWS_NEWS_LOGO', 'Logo pour la news');
define('_MA_XMNEWS_NEWS_MDATE', 'Date de modification');
define('_MA_XMNEWS_NEWS_MDATEUPDATE', 'Mettre à jour la date de modification');
define('_MA_XMNEWS_NEWS_MORE', 'Lire l\'article complet');
define('_MA_XMNEWS_NEWS_NEWS', 'Article');
define('_MA_XMNEWS_NEWS_NOTIFY', 'Me prévenir de la publication?');
define('_MA_XMNEWS_NEWS_ON', 'le');
define('_MA_XMNEWS_NEWS_PUBLISHEDBY', 'Publié par');
define('_MA_XMNEWS_NEWS_RATING', 'Évaluation');
define('_MA_XMNEWS_NEWS_READING', 'Lecture');
define('_MA_XMNEWS_NEWS_RESETMDATE', 'Réinitialiser (date vide)');
define('_MA_XMNEWS_NEWS_SELECTCATEGORY', 'Sélectionnez une catégorie pour filtrer les articles');
define('_MA_XMNEWS_NEWS_SUREDEL', 'Êtes-vous sûr de vouloir supprimer cet article? %s');
define('_MA_XMNEWS_NEWS_TITLE', 'Titre');
define('_MA_XMNEWS_NEWS_USELOGOCATEGORY', 'Utiliser le logo de la catégorie');
define('_MA_XMNEWS_NEWS_USERID', 'Auteur');
define('_MA_XMNEWS_NEWS_XMDOC', 'Documents');
define('_MA_XMNEWS_NEWS_VOTES', '(%s Votes)');
define('_MA_XMNEWS_NEWS_WAITING', 'Il y a <strong>%s</strong> articles en attente de validation!');
define('_MA_XMNEWS_NEWS_WFV', 'En attente de validation');

// blocks
define('_MA_XMNEWS_BLOCKS_DATE', 'Date');
define('_MA_XMNEWS_BLOCKS_NOWAITING', 'Il n\'y a pas d\'articles en attente de validation');

// permission
define('_MA_XMNEWS_PERMISSION_VIEW_ABSTRACT', 'Autorisation de voir le résumé d\'un article');
define('_MA_XMNEWS_PERMISSION_VIEW_ABSTRACT_DSC', 'Choisissez les groupes qui peuvent voir le résumé d\'un article dans ces catégories');
define('_MA_XMNEWS_PERMISSION_VIEW_ABSTRACT_THIS', 'Sélectionner les groupes pouvant voir le résumé dans ces catégories');
define('_MA_XMNEWS_PERMISSION_VIEW_NEWS', 'Autorisation de voir un article complet');
define('_MA_XMNEWS_PERMISSION_VIEW_NEWS_DSC', 'Choisissez les groupes qui peuvent voir un article complet dans ces catégories');
define('_MA_XMNEWS_PERMISSION_VIEW_NEWS_THIS', 'Sélectionner les groupes pouvant voir un article complet dans ces catégories');
define('_MA_XMNEWS_PERMISSION_SUBMIT', 'Autorisation de soumettre');
define('_MA_XMNEWS_PERMISSION_SUBMIT_DSC', 'Sélectionner les groupes pouvant soumettre des articles dans ces catégories');
define('_MA_XMNEWS_PERMISSION_SUBMIT_THIS', 'Sélectionner les groupes pouvant soumettre dans ces catégorie');
define('_MA_XMNEWS_PERMISSION_EDITAPPROVE', 'Autorisation de modifier et d\'aprouver');
define('_MA_XMNEWS_PERMISSION_EDITAPPROVE_DSC', 'Sélectionner les groupes pouvant éditer et aprouver des articles dans ces catégories');
define('_MA_XMNEWS_PERMISSION_EDITAPPROVE_THIS', 'Sélectionner les groupes pouvant éditer et aprouver dans ces catégorie');
define('_MA_XMNEWS_PERMISSION_DELETE', 'Autorisation de supprimer');
define('_MA_XMNEWS_PERMISSION_DELETE_DSC', 'Sélectionner les groupes pouvant supprimer des articles dans ces catégories');
define('_MA_XMNEWS_PERMISSION_DELETE_THIS', 'Sélectionner les groupes pouvant supprimer dans ces catégories');

// user
define('_MA_XMNEWS_SELECTCATEGORY', 'Sélectionnez une catégorie pour ajouter un élément à');

