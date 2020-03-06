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
// The name of this module
define('_MI_XMNEWS_NAME', 'Article');
define('_MI_XMNEWS_DESC', 'Gestion des articles');

// Menu
define('_MI_XMNEWS_MENU_HOME', 'Index');
define('_MI_XMNEWS_MENU_CATEGORY', 'Categories');
define('_MI_XMNEWS_MENU_NEWS', 'Articles');
define('_MI_XMNEWS_MENU_PERMISSION', 'Autorisations');
define('_MI_XMNEWS_MENU_ABOUT', 'À propos');

// Sub menu
define('_MI_XMNEWS_SUB_ADD', 'Soumettre un article');

// Block
define('_MI_XMNEWS_BLOCK_DATE', 'Articles récents');
define('_MI_XMNEWS_BLOCK_DATE_DESC', 'Afficher les articles récents');
define('_MI_XMNEWS_BLOCK_HITS', 'Top articles (lectures)');
define('_MI_XMNEWS_BLOCK_HITS_DESC', 'Afficher les top articles (lectures)');
define('_MI_XMNEWS_BLOCK_RATING', 'Articles les mieux notés');
define('_MI_XMNEWS_BLOCK_RATING_DESC', 'Afficher les articles les mieux notés');
define('_MI_XMNEWS_BLOCK_RANDOM', 'Articles aléatoires');
define('_MI_XMNEWS_BLOCK_RANDOM_DESC', 'Afficher les articles aléatoirement');
define('_MI_XMNEWS_BLOCK_WAITING', 'Articles en attente de validation');
define('_MI_XMNEWS_BLOCK_WAITING_DESC', 'Afficher les articles en attente de validation');
define('_MI_XMNEWS_BLOCK_ONENEWS', 'Afficher un article');
define('_MI_XMNEWS_BLOCK_ONENEWS_DESC', 'Afficher l\'article sélectionné');

// Pref
define('_MI_XMNEWS_PREF_HEAD_GENERAL', '<span style="font-size: large;  font-weight: bold;">Général</span>');
define('_MI_XMNEWS_PREF_GENERALITEMPERPAGE', 'Nombre d\'éléments par page dans la vue générale');
define('_MI_XMNEWS_PREF_GENERALXMDOC', 'Utiliser le module xmdoc pour ajouter un document');
define('_MI_XMNEWS_PREF_GENERALXMSOCIAL', 'Utiliser le module xmsocial pour noter un article');
define('_MI_XMNEWS_PREF_CAPTCHA', 'Utiliser Captcha?');
define('_MI_XMNEWS_PREF_CAPTCHA_DESC', 'Sélectionnez Oui pour utiliser Captcha dans le formulaire de soumission.');
define('_MI_XMNEWS_PREF_COUNTERTIME', 'Sélectionnez le temps pour laquelle le compteur de lecture d\'article peut être incrémenté par la même personne. [min]');
define('_MI_XMNEWS_PREF_COUNTERTIME_DESC', 'Mettre "0" si vous ne voulez pas de limitation');
define('_MI_XMNEWS_PREF_MAXUPLOADSIZE', 'Taille maximale des fichiers uploadés');
define('_MI_XMNEWS_PREF_MAXUPLOADSIZE_DESC', 'Cela concerne les logos uploadés pour les catégories et les actualités');
define('_MI_XMNEWS_PREF_MAXUPLOADSIZE_MBYTES', 'Mb');
define('_MI_XMNEWS_PREF_REDIRECT', 'Url de redirection si le visiteur n\'a pas accès à un article');
define('_MI_XMNEWS_PREF_REDIRECT_DESC', 'Vide, la redirection par défaut est utilisée (index.php). Cette option peut être utile pour rediriger le visiteur sur une page de souscription d\'un compte premium pour obtenir un accès total à l\'article désiré');
define('_MI_XMNEWS_PREF_HEAD_ADMIN', '<span style="font-size: large;  font-weight: bold;">Administration</span>');
define('_MI_XMNEWS_PREF_EDITOR', 'Éditeur de texte');
define('_MI_XMNEWS_PREF_ITEMPERPAGE', 'Nombre d\'éléments par page dans la vue d\'administration');
define('_MI_XMNEWS_PREF_HEAD_COMNOTI', '<span style="font-size: large;  font-weight: bold;">Commentaires et notifications</span>');
define('_MI_XMNEWS_NOTIFICATION_GLOBAL', 'Globale');
define('_MI_XMNEWS_NOTIFICATION_GLOBAL_DESC', 'Options de notification globales pour les articles.');
define('_MI_XMNEWS_NOTIFICATION_GLOBAL_NEWNEWS', 'Nouvel article');
define('_MI_XMNEWS_NOTIFICATION_GLOBAL_NEWNEWS_CAP', 'Prévenez-moi quand un nouvel article est publié.');
define('_MI_XMNEWS_NOTIFICATION_GLOBAL_NEWNEWS_DESC', 'Recevoir une notification lorsqu\'un nouvel article est publié.');
define('_MI_XMNEWS_NOTIFICATION_GLOBAL_NEWNEWS_SBJ', '[{X_SITENAME}] {X_MODULE} notification automatique: Nouveaux articles');
define('_MI_XMNEWS_NOTIFICATION_GLOBAL_SUBMITNEWS', 'Article soumis');
define('_MI_XMNEWS_NOTIFICATION_GLOBAL_SUBMITNEWS_CAP', 'Prévenez-moi quand un nouvel article est soumis (en attente d\'approbation).');
define('_MI_XMNEWS_NOTIFICATION_GLOBAL_SUBMITNEWS_DESC', 'Recevoir une notification lorsqu\'un nouvel article est soumis (en attente d\'approbation).');
define('_MI_XMNEWS_NOTIFICATION_GLOBAL_SUBMITNEWS_SBJ', '[{X_SITENAME}] {X_MODULE} auto-notifier: nouvel article soumis (en attente d\'approbation)');
define('_MI_XMNEWS_NOTIFICATION_CATEGORY', 'Categorie');
define('_MI_XMNEWS_NOTIFICATION_CATEGORY_DESC', 'Options de notification qui s\'appliquent à la catégorie d\'article actuel.');
define('_MI_XMNEWS_NOTIFICATION_CATEGORY_NEWNEWS', 'Nouvel article');
define('_MI_XMNEWS_NOTIFICATION_CATEGORY_NEWNEWS_CAP', 'Prévenez-moi quand un nouvel article est publié dans la catégorie actuelle.');
define('_MI_XMNEWS_NOTIFICATION_CATEGORY_NEWNEWS_DESC', 'Recevoir une notification lorsqu\'un nouvel article est publié dans la catégorie actuelle.');
define('_MI_XMNEWS_NOTIFICATION_CATEGORY_NEWNEWS_SBJ', '[{X_SITENAME}] {X_MODULE} notification automatique: nouvel article dans la catégorie');
define('_MI_XMNEWS_NOTIFICATION_NEWS', 'Articles');
define('_MI_XMNEWS_NOTIFICATION_NEWS_DESC', 'Options de notification qui s\'appliquent aux nouveaux articles.');
define('_MI_XMNEWS_NOTIFICATION_NEWS_MODIFIEDNEWS', 'Article modifié');
define('_MI_XMNEWS_NOTIFICATION_NEWS_MODIFIEDNEWS_CAP', 'M\'avertir lorsque cet article est modifié');
define('_MI_XMNEWS_NOTIFICATION_NEWS_MODIFIEDNEWS_DESC', 'Recevoir une notification lorsque cet article est modifié.');
define('_MI_XMNEWS_NOTIFICATION_NEWS_MODIFIEDNEWS_SBJ', '[{X_SITENAME}] {X_MODULE} notification automatique: article modifié');
define('_MI_XMNEWS_NOTIFICATION_NEWS_APPROVE', 'Article approuvé');
define('_MI_XMNEWS_NOTIFICATION_NEWS_APPROVE_CAP', 'Me prévenir lorsque cet article est approuvé');
define('_MI_XMNEWS_NOTIFICATION_NEWS_APPROVE_DESC', 'Recevoir une notification lorsque cet article est approuvé.');
define('_MI_XMNEWS_NOTIFICATION_NEWS_APPROVE_SBJ', '[{X_SITENAME}] {X_MODULE} notification automatique: Article approuvé');
