/*
SQLyog Community v12.2.6 (64 bit)
MySQL - 5.7.15-log : Database - cmsi
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cmsi` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `cmsi`;

/*Table structure for table `tb_documentos` */

DROP TABLE IF EXISTS `tb_documentos`;

CREATE TABLE `tb_documentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_documento_tipo` int(11) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `setor` varchar(255) NOT NULL,
  `responsavel` varchar(255) NOT NULL,
  `laudo` text NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `dt_cadastro` datetime DEFAULT CURRENT_TIMESTAMP,
  `dt_update` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_doc_tipo` (`id_documento_tipo`),
  KEY `fk_doc_user` (`id_usuario`),
  CONSTRAINT `fk_doc_tipo` FOREIGN KEY (`id_documento_tipo`) REFERENCES `tb_documentos_tipo` (`id`),
  CONSTRAINT `fk_doc_user` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tb_documentos` */

LOCK TABLES `tb_documentos` WRITE;

UNLOCK TABLES;

/*Table structure for table `tb_documentos_itens` */

DROP TABLE IF EXISTS `tb_documentos_itens`;

CREATE TABLE `tb_documentos_itens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_documento` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `patrimonio` int(11) DEFAULT NULL,
  `numero_serie` varchar(50) DEFAULT NULL,
  `metros` double DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `dt_cadastro` datetime DEFAULT CURRENT_TIMESTAMP,
  `dt_update` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_item_doc` (`id_documento`),
  CONSTRAINT `fk_item_doc` FOREIGN KEY (`id_documento`) REFERENCES `tb_documentos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tb_documentos_itens` */

LOCK TABLES `tb_documentos_itens` WRITE;

UNLOCK TABLES;

/*Table structure for table `tb_documentos_tipo` */

DROP TABLE IF EXISTS `tb_documentos_tipo`;

CREATE TABLE `tb_documentos_tipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tb_documentos_tipo` */

LOCK TABLES `tb_documentos_tipo` WRITE;

UNLOCK TABLES;

/*Table structure for table `tb_estoque` */

DROP TABLE IF EXISTS `tb_estoque`;

CREATE TABLE `tb_estoque` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produto` varchar(255) NOT NULL,
  `qtd` int(11) NOT NULL,
  `patrimonio` int(11) DEFAULT NULL,
  `caixa` varchar(100) DEFAULT NULL,
  `garantia` date DEFAULT NULL,
  `dt_cadastro` datetime DEFAULT CURRENT_TIMESTAMP,
  `dt_update` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `tb_estoque` */

LOCK TABLES `tb_estoque` WRITE;

insert  into `tb_estoque`(`id`,`produto`,`qtd`,`patrimonio`,`caixa`,`garantia`,`dt_cadastro`,`dt_update`) values 
(1,'ABRACADEIRAS 10CM(SACO)',25,NULL,NULL,NULL,'2017-03-22 16:10:32','2017-03-27 23:39:29'),
(3,'access point dlink',2,NULL,'12',NULL,'2017-03-22 18:58:59','2017-03-22 18:58:59'),
(4,'ADAPTADORES VOIP 2',12,NULL,'20',NULL,'2017-03-22 19:20:57','2017-03-22 19:20:57');

UNLOCK TABLES;

/*Table structure for table `tb_log` */

DROP TABLE IF EXISTS `tb_log`;

CREATE TABLE `tb_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_usuario` bigint(20) NOT NULL,
  `local` varchar(50) CHARACTER SET latin1 NOT NULL,
  `acao` varchar(150) NOT NULL,
  `dt_ocorrencia` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8;

/*Data for the table `tb_log` */

LOCK TABLES `tb_log` WRITE;

insert  into `tb_log`(`id`,`id_usuario`,`local`,`acao`,`dt_ocorrencia`) values 
(122,1,'Usuários','Alteração de Usuário','2017-02-26 21:40:37'),
(123,1,'Usuários','Alteração de Usuário','2017-02-26 21:40:44'),
(124,1,'Usuários','Alteração de Senha','2017-02-27 01:44:04'),
(125,1,'Usuários','Alteração de Senha','2017-02-27 01:44:28');

UNLOCK TABLES;

/*Table structure for table `tb_setor` */

DROP TABLE IF EXISTS `tb_setor`;

CREATE TABLE `tb_setor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sigla` varchar(20) NOT NULL,
  `setor` varchar(255) NOT NULL,
  `ramal` varchar(50) DEFAULT NULL,
  `responsavel` varchar(255) DEFAULT NULL,
  `dt_cadastro` datetime DEFAULT CURRENT_TIMESTAMP,
  `dt_update` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tb_setor` */

LOCK TABLES `tb_setor` WRITE;

insert  into `tb_setor`(`id`,`sigla`,`setor`,`ramal`,`responsavel`,`dt_cadastro`,`dt_update`) values 
(1,'ASSIFPB','Associação dos Servidores','1385','Chico','2017-03-27 23:24:52','2017-03-27 23:24:52'),
(2,'CAC','Coordenação de Arquivo Central','1389','Anna Carla/ Alex/ Suênia','2017-03-27 23:34:37','2017-03-27 23:34:37');

UNLOCK TABLES;

/*Table structure for table `tb_usuarios` */

DROP TABLE IF EXISTS `tb_usuarios`;

CREATE TABLE `tb_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(40) NOT NULL,
  `tipo` int(20) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '0',
  `ultimo_acesso` timestamp NULL DEFAULT NULL,
  `dt_criacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `id_usr_ tipo_fk` (`tipo`),
  CONSTRAINT `fk_user_tipo` FOREIGN KEY (`tipo`) REFERENCES `tb_usuarios_tipo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

/*Data for the table `tb_usuarios` */

LOCK TABLES `tb_usuarios` WRITE;

insert  into `tb_usuarios`(`id`,`nome`,`email`,`senha`,`tipo`,`ativo`,`ultimo_acesso`,`dt_criacao`) values 
(1,'Administrador','admin@admin.net','6b603cd7ea25ac3ccced370137c82bddcb08d508',1,1,'2017-05-20 13:03:50','2017-05-20 13:03:50'),
(55,'yuri anderson silva canuto','yuriasc@hotmail.com','6b603cd7ea25ac3ccced370137c82bddcb08d508',1,1,'2017-05-20 12:42:54','2017-05-20 12:42:54'),
(56,'teste','yuriasc@gmail.com','6b603cd7ea25ac3ccced370137c82bddcb08d508',2,0,NULL,'2017-05-19 20:13:28');

UNLOCK TABLES;

/*Table structure for table `tb_usuarios_seg` */

DROP TABLE IF EXISTS `tb_usuarios_seg`;

CREATE TABLE `tb_usuarios_seg` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(20) NOT NULL DEFAULT '0',
  `usuarios` tinyint(1) NOT NULL DEFAULT '0',
  `estoque` tinyint(1) NOT NULL DEFAULT '0',
  `documentos` tinyint(1) NOT NULL DEFAULT '0',
  `dt_update` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `dt_criacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_usr_fk` (`id_usuario`),
  CONSTRAINT `fk_user_seg` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*Data for the table `tb_usuarios_seg` */

LOCK TABLES `tb_usuarios_seg` WRITE;

insert  into `tb_usuarios_seg`(`id`,`id_usuario`,`usuarios`,`estoque`,`documentos`,`dt_update`,`dt_criacao`) values 
(12,55,1,1,1,'2017-05-20 13:03:17','2017-05-20 12:35:25'),
(19,1,1,1,1,'2017-05-20 13:03:45','2017-05-20 12:59:21');

UNLOCK TABLES;

/*Table structure for table `tb_usuarios_tipo` */

DROP TABLE IF EXISTS `tb_usuarios_tipo`;

CREATE TABLE `tb_usuarios_tipo` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `tb_usuarios_tipo` */

LOCK TABLES `tb_usuarios_tipo` WRITE;

insert  into `tb_usuarios_tipo`(`id`,`nome`) values 
(1,'Administrador'),
(2,'Estagiário');

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
