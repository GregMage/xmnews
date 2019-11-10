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
define('_MI_XMNEWS_NAME', 'News');
define('_MI_XMNEWS_DESC', 'Gestion de news');

// Menu
define('_MI_XMNEWS_MENU_HOME', 'Index');
define('_MI_XMNEWS_MENU_CATEGORY', 'Categories');
define('_MI_XMNEWS_MENU_NEWS', 'News');
define('_MI_XMNEWS_MENU_PERMISSION', 'Autorisations');
define('_MI_XMNEWS_MENU_ABOUT', 'À propos');

// Sub menu
define('_MI_XMNEWS_SUB_ADD', 'Soumettre une news');

// Block
define('_MI_XMNEWS_BLOCK_DATE', 'News récentes');
define('_MI_XMNEWS_BLOCK_DATE_DESC', 'Afficher les news récentes');
define('_MI_XMNEWS_BLOCK_HITS', 'Top News (lectures)');
define('_MI_XMNEWS_BLOCK_HITS_DESC', 'Afficher les top news (lectures)');
define('_MI_XMNEWS_BLOCK_RATING', 'News les mieux notées');
define('_MI_XMNEWS_BLOCK_RATING_DESC', 'Afficher les news les mieux notées');
define('_MI_XMNEWS_BLOCK_RANDOM', 'News aléatoire');
define('_MI_XMNEWS_BLOCK_RANDOM_DESC', 'Afficher les news aléatoirement');
define('_MI_XMNEWS_BLOCK_WAITING', 'News en attente de validation');
define('_MI_XMNEWS_BLOCK_WAITING_DESC', 'Afficher les news en attente de validation');

// Pref
define('_MI_XMNEWS_PREF_HEAD_GENERAL', '<span style="font-size: large;  font-weight: bold;">Général</span>');
define('_MI_XMNEWS_PREF_GENERALITEMPERPAGE', 'Nombre d\'éléments par page dans la vue générale');
define('_MI_XMNEWS_PREF_GENERALXMDOC', 'Utiliser le module xmdoc pour ajouter un document');
define('_MI_XMNEWS_PREF_CAPTCHA', 'Utiliser Captcha?');
define('_MI_XMNEWS_PREF_CAPTCHA_DESC', 'Sélectionnez Oui pour utiliser Captcha dans le formulaire de soumission.');
define('_MI_XMNEWS_PREF_COUNTERTIME', 'Sélectionnez le temps à laquelle le compteur de lecture de news peut être incrémenté par la même personne. [min]');
define('_MI_XMNEWS_PREF_COUNTERTIME_DESC', 'Mettre "0" si vous ne voulez de limitation');
define('_MI_XMNEWS_PREF_MAXUPLOADSIZE', 'Taille maximale des fichiers uploadé');
define('_MI_XMNEWS_PREF_MAXUPLOADSIZE_DESC', 'Cela concerne les logos uploadés pour les catégories et les actualités');
define('_MI_XMNEWS_PREF_MAXUPLOADSIZE_MBYTES', 'Mb');
define('_MI_XMNEWS_PREF_HEAD_ADMIN', '<span style="font-size: large;  font-weight: bold;">Administration</span>');
define('_MI_XMNEWS_PREF_EDITOR', 'Éditeur de texte');
define('_MI_XMNEWS_PREF_ITEMPERPAGE', 'Nombre d\'éléments par page dans la vue d\'administration');
define('_MI_XMNEWS_PREF_HEAD_COMNOTI', '<span style="font-size: large;  font-weight: bold;">Commentaires et notifications</span>');
define('_MI_XMNEWS_NOTIFICATION_GLOBAL', 'Globale');
define('_MI_XMNEWS_NOTIFICATION_GLOBAL_DESC', 'GOptions de notification globales pour les news.');
define('_MI_XMNEWS_NOTIFICATION_GLOBAL_NEWNEWS', 'Nouvelle news');
define('_MI_XMNEWS_NOTIFICATION_GLOBAL_NEWNEWS_CAP', 'Prévenez-moi quand une nouvelle news est publiée.');
define('_MI_XMNEWS_NOTIFICATION_GLOBAL_NEWNEWS_DESC', 'Recevoir une notification lorsqu\'une nouvelle news est publiée.');
define('_MI_XMNEWS_NOTIFICATION_GLOBAL_NEWNEWS_SBJ', '[{X_SITENAME}] {X_MODULE} notification automatique: Nouvelles news');
define('_MI_XMNEWS_NOTIFICATION_GLOBAL_SUBMITNEWS', 'News soumise');
define('_MI_XMNEWS_NOTIFICATION_GLOBAL_SUBMITNEWS_CAP', 'Prévenez-moi quand une nouvelle news est soumise (en attente d\'approbation).');
define('_MI_XMNEWS_NOTIFICATION_GLOBAL_SUBMITNEWS_DESC', 'Recevoir une notification lorsqu\'une nouvelle new est soumise (en attente d\'approbation).');
define('_MI_XMNEWS_NOTIFICATION_GLOBAL_SUBMITNEWS_SBJ', '[{X_SITENAME}] {X_MODULE} auto-notifier: nouvel article soumis (en attente d\'approbation)');
define('_MI_XMNEWS_NOTIFICATION_CATEGORY', 'Categorie');
define('_MI_XMNEWS_NOTIFICATION_CATEGORY_DESC', 'Options de notification qui s\'appliquent à la catégorie de news actuelle.');
define('_MI_XMNEWS_NOTIFICATION_CATEGORY_NEWNEWS', 'Nouvelle news');
define('_MI_XMNEWS_NOTIFICATION_CATEGORY_NEWNEWS_CAP', 'Prévenez-moi quand une nouvelle news est publiée dans la catégorie actuelle.');
define('_MI_XMNEWS_NOTIFICATION_CATEGORY_NEWNEWS_DESC', 'Recevoir une notification lorsqu\'une nouvelle news est publiée dans la catégorie actuelle.');
define('_MI_XMNEWS_NOTIFICATION_CATEGORY_NEWNEWS_SBJ', '[{X_SITENAME}] {X_MODULE} notification automatique: nouvelle news dans la catégorie');
define('_MI_XMNEWS_NOTIFICATION_NEWS', 'News');
define('_MI_XMNEWS_NOTIFICATION_NEWS_DESC', 'Options de notification qui s\'appliquent aux nouvelles news.');
define('_MI_XMNEWS_NOTIFICATION_NEWS_MODIFIEDNEWS', 'News modifiée');
define('_MI_XMNEWS_NOTIFICATION_NEWS_MODIFIEDNEWS_CAP', 'M\'avertir lorsque cette news est modifiée');
define('_MI_XMNEWS_NOTIFICATION_NEWS_MODIFIEDNEWS_DESC', 'Recevoir une notification lorsque cette news est modifiée.');
define('_MI_XMNEWS_NOTIFICATION_NEWS_MODIFIEDNEWS_SBJ', '[{X_SITENAME}] {X_MODULE} notification automatique: news modifiée');
define('_MI_XMNEWS_NOTIFICATION_NEWS_APPROVE', 'News approuvée');
define('_MI_XMNEWS_NOTIFICATION_NEWS_APPROVE_CAP', 'Me prévenir lorsque cette news est approuvée');
define('_MI_XMNEWS_NOTIFICATION_NEWS_APPROVE_DESC', 'Recevoir une notification lorsque cette nouvelle est approuvée.');
define('_MI_XMNEWS_NOTIFICATION_NEWS_APPROVE_SBJ', '[{X_SITENAME}] {X_MODULE} notification automatique: News approuvée');
