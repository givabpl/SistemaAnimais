CREATE DATABASE  IF NOT EXISTS `sistema-vet` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `sistema-vet`;
-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: sistema-vet
-- ------------------------------------------------------
-- Server version	8.0.37

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `achados`
--

DROP TABLE IF EXISTS `achados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `achados` (
  `id_achado` int NOT NULL AUTO_INCREMENT,
  `especie` varchar(100) DEFAULT NULL,
  `raca` varchar(100) DEFAULT NULL,
  `pelagem` varchar(100) DEFAULT NULL,
  `sexo` varchar(40) DEFAULT NULL,
  `imagem` varchar(100) DEFAULT NULL,
  `localac` varchar(100) DEFAULT NULL,
  `dataac` date DEFAULT NULL,
  `horaac` time DEFAULT NULL,
  `descritivo` varchar(500) DEFAULT NULL,
  `nome_pessoa` varchar(45) DEFAULT NULL,
  `sobrenome` varchar(45) DEFAULT NULL,
  `telefone1` varchar(20) DEFAULT NULL,
  `telefone2` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_achado`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `achados`
--

LOCK TABLES `achados` WRITE;
/*!40000 ALTER TABLE `achados` DISABLE KEYS */;
INSERT INTO `achados` VALUES (6,'cachorro','pinscher','Curta e preta','Ni','src/achados-img/pinscher.jpg','Jardim Regina','2024-08-16','13:39:00','Cachorro com muita sede. Está desde manhã na rua.','Giovana','Balestrero','(014) 9 0000-0000','');
/*!40000 ALTER TABLE `achados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `animais`
--

DROP TABLE IF EXISTS `animais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `animais` (
  `id_animal` int NOT NULL AUTO_INCREMENT,
  `rga` varchar(45) DEFAULT NULL,
  `chip` varchar(45) DEFAULT NULL,
  `nome` varchar(45) NOT NULL,
  `datan` date DEFAULT NULL,
  `sexo` varchar(10) DEFAULT NULL,
  `alergias` varchar(200) DEFAULT NULL,
  `doencas` varchar(400) DEFAULT NULL,
  `cirurgias` varchar(300) DEFAULT NULL,
  `peso` varchar(6) DEFAULT NULL,
  `especie` varchar(45) NOT NULL,
  `raca` varchar(45) NOT NULL,
  `pelagem` varchar(45) NOT NULL,
  `aquisicao` varchar(45) DEFAULT NULL,
  `id_tutor` int DEFAULT NULL,
  `statusan` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_animal`),
  KEY `fk_id_tutor` (`id_tutor`),
  CONSTRAINT `fk_id_tutor` FOREIGN KEY (`id_tutor`) REFERENCES `tutores` (`id_tutor`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `animais`
--

LOCK TABLES `animais` WRITE;
/*!40000 ALTER TABLE `animais` DISABLE KEYS */;
INSERT INTO `animais` VALUES (15,'47987948','HJD88PP','Gatito','2022-07-08','Fêmea','Não','Não','Não','4,5','Felino','Laranja','Curta','Adotado',1,NULL),(16,'97069705','h86h5fv42f','Cachorrito','2016-10-12','Macho','Não','Diabetes','Castração','8','Canino','SRD','Curta','Adotado',1,NULL),(17,'46839423','JSUP94374j','Fuleco','2014-02-18','Macho','Não','Não','Não','4.8','Tatu','Bola','blindada','roubado',1,NULL),(18,'8439900','93jdh838jn','Louro José','1997-03-28','Macho','Não','Não','Não','0.2','Ave','Papagaio','...','Inventado',5,NULL),(19,'9320390','4354g533gd','Belinha','2002-06-09','Fêmea','Não','Não','Castração','6.1','Canino','Puldo','Enrolada','Comprado',1,NULL),(20,'15245234','67rg46rd','Panda','2020-08-15','Fêmea','Não','Não','Castração','4.2','Felino','Siamês','Curta','Resgatado',6,NULL),(21,'212121212','03940333ff3','Kim','2018-09-08','Macho','Não','Não','Castração','6.4','Felino','Bombaim','Curta','Adotado',6,NULL),(22,'0039002','jsdf6327','Puma','2024-03-01','Macho','Não','Não','Não','3.4','Felino','Bombaim','Longa','Adotado',7,NULL),(23,'090003','749823','Tobias','2015-09-26','Macho','Não','Não','Castração','18.9','Canino','SRD','Curta','Adotado',4,NULL),(29,'','','Chico','2024-02-09','Macho','Não','','Não','6','cachorro','Pinscher','Curta e preta','Adotado',16,NULL),(30,'','','Belinha','2013-04-27','Fêmea','','','Castração','6','cachorro','Poodle','branca e enrolada','Comprado',17,NULL),(32,'','','Totó','2024-07-10','Macho','','','','14.2','cachorro','SRD','marrom e branca, curta','Adotado',19,NULL),(33,'','','',NULL,'Macho','','','','','cachorro','pinscher','Curta e preta','',NULL,NULL),(34,'','','',NULL,'Macho','','','','','cachorro','pinscher','Curta e preta','',NULL,NULL),(35,'','','',NULL,'Macho','','','','','cachorro','pinscher','Curta e preta','',NULL,NULL),(36,'','','',NULL,'Macho','','','','','cachorro','pinscher','Curta e preta','',NULL,NULL),(37,'','','',NULL,'Macho','','','','','cachorro','pinscher','Curta e preta','',NULL,NULL),(38,'','','',NULL,'Fêmea','','','','','gato','SRD/Calico','Longa -  laranja, preto e branco','',NULL,NULL),(39,'435830983','6473984','Mia','2020-05-12','Fêmea','Não','Não','Castração','6.8','Felino','SRD','Longa cinza e branco','Adotado',4,NULL),(40,'237493','9080909','Gatita','2022-03-04','Fêmea','Não','Não','Castração','4.8','Felino','SRD','Preta curta','Adotado',3,NULL),(41,'543553','343312','Celine','2023-10-11','Fêmea','Não','Não','Castração','4.9','Felino','SRD','cinza rajada curta','Adotado',5,NULL),(42,'-','-','Kikinho','2024-05-01','Macho','Não','Não','Não','4.4','Felino','SRD','Curta e preta','Resgatado',20,NULL),(43,'---','---','Pitica','2024-05-04','Fêmea','Não','Não','Não','6.7','Felino','SRD','Curta branca e laranja','Resgatado',20,NULL),(45,'---','---','Perrito','2023-09-07','Macho','Não','Não','Castração','14.3','Canino','SRD','Curta e preta','Adotado',9,NULL),(55,'','','',NULL,'Fêmea','','','','','gato','Siamês','Curta, bege e preta','',NULL,NULL),(56,'','','',NULL,'Macho','','','','','cachorro','Golden','Longa e amarela','',NULL,NULL),(57,'1.111.111','4324000049473','Raio','2024-07-19','Macho','Não','Não','Não','12','cachorro','SRD','Longa','Adotado',29,NULL),(58,'1.111.111','4324000049473','Raio','2024-07-19','Macho','Não','Não','Não','12','cachorro','SRD','Longa','Adotado',30,NULL),(59,'5.555.555','9407745222010594','Bananinha','2022-02-07','Macho','Não','Diabetes','Castração','6.2','cachorro','salsicha','amarelo','Comprado',31,NULL),(60,'','','',NULL,'Macho','','','','','cachorro','SRD','média, preto com marrom','',NULL,NULL);
/*!40000 ALTER TABLE `animais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perdidos`
--

DROP TABLE IF EXISTS `perdidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perdidos` (
  `id_perdido` int NOT NULL AUTO_INCREMENT,
  `rga` varchar(45) DEFAULT NULL,
  `chip` varchar(45) DEFAULT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `datan` date DEFAULT NULL,
  `sexo` varchar(45) DEFAULT NULL,
  `alergias` varchar(45) DEFAULT NULL,
  `doencas` varchar(45) DEFAULT NULL,
  `peso` varchar(45) DEFAULT NULL,
  `especie` varchar(45) DEFAULT NULL,
  `raca` varchar(45) DEFAULT NULL,
  `pelagem` varchar(45) DEFAULT NULL,
  `imagem` varchar(200) DEFAULT NULL,
  `descritivo` varchar(1000) DEFAULT NULL,
  `locald` varchar(1000) DEFAULT NULL,
  `datad` date DEFAULT NULL,
  `horad` time DEFAULT NULL,
  `nome_tutor` varchar(45) DEFAULT NULL,
  `sobrenome` varchar(45) DEFAULT NULL,
  `telefone1` varchar(45) DEFAULT NULL,
  `telefone2` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_perdido`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perdidos`
--

LOCK TABLES `perdidos` WRITE;
/*!40000 ALTER TABLE `perdidos` DISABLE KEYS */;
INSERT INTO `perdidos` VALUES (9,'0.000.000','00000000','Thor','2017-10-16','Macho','Não','Não','19.5','cachorro','Golden','Longa e amarela','src/perdidos-img/golden.jpg','adsdaa aa aaaaaaaa asdsadsa\r\nasdasdsd asfddf\r\n\r\nf fafa','Santa Cecília','2024-08-14','11:31:00','Julia','Silva','(014) 0 0000-0000',''),(10,'0.000.000','00000000000','Pitica','2015-07-15','Fêmea','Não','Não','4.7','Felino','Siamês','Curta, bege e preta','src/perdidos-img/siames.jpg','Pulou o muro no fim da tarde e não voltou. Usa coleira com sino. É bem dócil.\r\nEla não costuma escapar, ela tem medo.','Av Rui Barbosa','2024-08-07','18:20:00','Pedro','Mamoni','(014) 0 0000-0000','');
/*!40000 ALTER TABLE `perdidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prontuarios`
--

DROP TABLE IF EXISTS `prontuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prontuarios` (
  `id_pront` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) NOT NULL,
  `dataa` date NOT NULL,
  `locala` varchar(45) NOT NULL,
  `descritivo` varchar(5000) NOT NULL,
  `medicacao` varchar(45) DEFAULT NULL,
  `medicacao_info` varchar(600) DEFAULT NULL,
  `internacao` varchar(45) DEFAULT NULL,
  `internacao_info` varchar(600) DEFAULT NULL,
  `receita` varchar(700) DEFAULT NULL,
  `arquivo` varchar(400) NOT NULL,
  `peso` varchar(45) DEFAULT NULL,
  `id_animal` int NOT NULL,
  `id_vet` int NOT NULL,
  PRIMARY KEY (`id_pront`),
  KEY `fk_id_animal` (`id_animal`),
  KEY `fk_id_vet` (`id_vet`),
  CONSTRAINT `fk_id_animal` FOREIGN KEY (`id_animal`) REFERENCES `animais` (`id_animal`),
  CONSTRAINT `fk_id_vet` FOREIGN KEY (`id_vet`) REFERENCES `veterinarios` (`id_vet`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prontuarios`
--

LOCK TABLES `prontuarios` WRITE;
/*!40000 ALTER TABLE `prontuarios` DISABLE KEYS */;
INSERT INTO `prontuarios` VALUES (6,'Primeira Consulta','2024-07-17','Posto 1','vacinas em ordem\r\n**Temperatura Corporal:** [Temperatura Corporal]\r\n**Frequência Respiratória:** [Frequência Respiratória]\r\n\r\n**Medicação:** [Medicação Prescrita]\r\n**Dosagem:** [Dosagem da Medicação]\r\n**Duração:** [Duração do Tratamento]\r\n**Outras Recomendações:** [Outras Recomendações]',NULL,NULL,NULL,NULL,NULL,'',NULL,15,1),(8,'Lesão pata','2024-07-19','Posto 2','## Motivo da Consulta\r\n- **Descrição:** [Descrição do Motivo da Consulta]\r\n\r\n## Exame Físico\r\n- **Temperatura Corporal:** [Temperatura Corporal]\r\n- **Frequência Cardíaca:** [Frequência Cardíaca]\r\n- **Frequência Respiratória:** [Frequência Respiratória]\r\n- **Estado Geral:** [Estado Geral do Animal]\r\n- **Sistema Respiratório:** [Avaliação do Sistema Respiratório]\r\n\r\n## Exames Complementares\r\n- **Exames Solicitados:** [Lista de Exames Solicitados]\r\n- **Resultados dos Exames:** [Resultados dos Exames]\r\n\r\n## Diagnóstico Definitivo\r\n- **Diagnóstico:** [Diagnóstico Definitivo]\r\n\r\n## Plano Terapêutico\r\n- **Medicação:** [Medicação Prescrita]\r\n- **Dosagem:** [Dosagem da Medicação]\r\n- **Duração:** [Duração do Tratamento]\r\n- **Outras Recomendações:** [Outras Recomendações]\r\n\r\n## Procedimentos Realizados\r\n- **Procedimento:** [Descrição do Procedimento Realizado]\r\n- **Data:** [Data do Procedimento]\r\n\r\n### Notas Finais\r\nEste prontuário deve ser mantido atualizado em cada consulta e revisão do paciente. Todos os dados devem ser inseridos de maneira precisa e detalhada para garantir o melhor atendimento ao animal.\r\n\r\n',NULL,NULL,NULL,NULL,NULL,'gato.jpg',NULL,20,2),(9,'Dor e febre','2024-07-11','Posto 4','## Plano Terapêutico\r - **Medicação:** [Medicação Prescrita]',NULL,NULL,NULL,NULL,NULL,'cachorro.jpg',NULL,19,5),(13,'Primeira Consulta','2023-03-17','Posto 2','## Motivo da Consulta\r\n- **Descrição:** [Descrição do Motivo da Consulta]\r\n\r\n## Exame Físico\r\n- **Temperatura Corporal:** [Temperatura Corporal]\r\n- **Frequência Cardíaca:** [Frequência Cardíaca]\r\n- **Frequência Respiratória:** [Frequência Respiratória]\r\n- **Estado Geral:** [Estado Geral do Animal]\r\n- **Mucosas:** [Descrição das Mucosas]\r\n- **Pele e Pelagem:** [Condição da Pele e Pelagem]\r\n- **Linfonodos:** [Avaliação dos Linfonodos]\r\n- **Sistema Respiratório:** [Avaliação do Sistema Respiratório]\r\n- **Sistema Cardiovascular:** [Avaliação do Sistema Cardiovascular]\r\n- **Sistema Digestório:** [Avaliação do Sistema Digestório]\r\n- **Sistema Urinário:** [Avaliação do Sistema Urinário]\r\n- **Sistema Musculoesquelético:** [Avaliação do Sistema Musculoesquelético]\r\n- **Sistema Nervoso:** [Avaliação do Sistema Nervoso]\r\n\r\n## Diagnóstico Presuntivo\r\n- **Diagnóstico:** [Diagnóstico Presuntivo]\r\n\r\n## Exames Complementares\r\n- **Exames Solicitados:** [Lista de Exames Solicitados]\r\n- **Resultados dos Exames:** [Resultados dos Exames]\r\n\r\n## Diagnóstico Definitivo\r\n- **Diagnóstico:** [Diagnóstico Definitivo]\r\n\r\n## Plano Terapêutico\r\n- **Medicação:** [Medicação Prescrita]\r\n- **Dosagem:** [Dosagem da Medicação]\r\n- **Duração:** [Duração do Tratamento]\r\n- **Outras Recomendações:** [Outras Recomendações]\r\n',NULL,NULL,NULL,NULL,NULL,'Ficha do animal de estimação.pdf',NULL,18,5),(16,'Primeira Consulta','2024-07-11','Posto 1','Vermifugação\r\n\r\nExame Físico\r\nTemperatura: 38.5°C\r\nFrequência Cardíaca: 90 bpm\r\nFrequência Respiratória: 20 rpm\r\nMucosas: Normais\r\nHidratação: Adequada\r\n\r\nDiagnóstico\r\nDiagnóstico Principal: Saúde geral boa\r\nDiagnósticos Secundários: Nenhum\r\n\r\nTratamento Prescrito\r\nMedicação: Vermífugo (Milbemax) - 1 comprimido\r\n\r\nRecomendações: Continuar alimentação balanceada, exercício regular, próximo check-up em um ano',NULL,NULL,NULL,NULL,NULL,'gato.png',NULL,22,3),(17,'Segunda consulta','2024-07-29','Posto 2','teste update peso\r\npeso antigo 6kg\r\nnovo peso 7kg',NULL,NULL,NULL,NULL,NULL,'','7',15,1),(18,'Terceira consulta','2024-07-30','Posto 2','Lorem ipsum dolor sit amet, consectetur adipiscing elit, \r\nsed do eiusmod tempor incididunt ut labore et dolore magna aliqua. \r\nUt enim ad minim veniam, quis nostrud exercitation ullamco\r\nlaboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu','Sim','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore ','Não','','Lorem ipsum dolor \r\nsit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut \r\nlabore et dolore magna aliqua. \r\nUt enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut \r\n\r\naliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu','','8',15,1),(19,'AAAAAAAAAA','2024-08-01','Posto 4','fdfsaaaaaaaaarg\r\ngagfakriqpwokpsf\r\nfsdfjsdahfkjsdahfuiwehfwuiefkDF','','','','','','','',15,1),(20,'AAAAAAAAAA','2024-08-01','Posto 4','fdfsaaaaaaaaarg\r\ngagfakriqpwokpsf\r\nfsdfjsdahfkjsdahfuiwehfwuiefkDF','Não','','Não','','aaaaaaaaaaaaaaaaaa\r\naaaaaaaaaaaaaaaaaaaaaaa\r\naaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa\r\naaaaaaaaaaaaaaaaa','','4,5',15,1),(22,'Primeira Consulta','2024-08-01','Posto 4','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer placerat nisi eget nisi placerat, quis euismod turpis dignissim. \r\nSuspendisse imperdiet non ex vitae congue. \r\n\r\nDonec leo sem, bibendum in semper ut, fringilla sed massa. Mauris eleifend tortor justo, ac sagittis sapien luctus id. \r\nUt auctor sem pretium risus commodo volutpat. Vivamus bibendum bibendum enim at finibus. Sed rutrum feugiat dui ac porttitor. Fusce ut ante dapibus, posuere risus vel, consectetur eros. \r\n\r\nNulla efficitur bibendum orci eu tempor. Sed hendrerit lorem turpis, non pulvinar sapien accumsan eget. \r\nCras tincidunt massa tempor risus mattis hendrerit. Vivamus aliquet tellus eleifend ante auctor ultricies.','Sim','Lorem ipsum dolor sit amet, consectetur adipiscing elit. \r\n\r\nInteger placerat nisi eget nisi placerat, quis euismod turpis dignissim.','Não','','Suspendisse imperdiet non ex vitae congue. \r\n\r\nDonec leo sem, bibendum in semper ut, fringilla sed massa. \r\n\r\nMauris eleifend tortor justo, ac sagittis sapien luctus id. Ut auctor sem pretium risus commodo volutpat.\r\n\r\n','','8',16,1),(23,'Segunda consulta','2024-08-06','Posto 1','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. \r\nUt enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. \r\n\r\nDuis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. \r\nExcepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit.\r\n\r\nIn reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. ','','','','','','','',20,1),(24,'Segunda consulta','2024-08-06','Posto 1','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. \r\nUt enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. \r\n\r\nDuis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. \r\nExcepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit.\r\n\r\nIn reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. ','Sim','Cupidatat non proident.','Sim','Cupidatat non proident.Cupidatat non proident.','Sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit.\r\n\r\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.','','4.2',20,1),(25,'Primeira Consulta','2024-08-06','Posto 2','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. \r\nUt enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. \r\n\r\nDuis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. \r\nExcepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit.','','','','','','','',42,1),(26,'Primeira Consulta','2024-08-06','Posto 2','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. \r\nUt enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. \r\n\r\nDuis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. \r\nExcepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit.','Sim','Cupidatat non proident.','Não','','Sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit.\r\n\r\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.','','4.4',42,1),(27,'Primeira Consulta','2024-08-06','Posto 1','Sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit.\r\n\r\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.','','','','','','','',40,2),(28,'Primeira Consulta','2024-08-06','Posto 1','Sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit.\r\n\r\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.','Não','','Não','','','','4.8',40,2),(29,'Segunda consulta','2024-08-05','Posto 4','Sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit.\r\n\r\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.','','','','','','','',19,2),(30,'Segunda consulta','2024-08-05','Posto 4','Sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit.\r\n\r\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.','Sim','Cupidatat non proident.\r\nSunt in culpa qui officia deserunt mollit anim id est laborum.','Não','','Cupidatat non proident.\r\nSunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit.\r\n\r\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.','','6.1',19,2),(31,'Segunda consulta','2024-08-04','Posto 4','Cupidatat non proident.\r\nSunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit.\r\n\r\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.','','','','','','','',18,2),(32,'Segunda consulta','2024-08-04','Posto 4','Cupidatat non proident.\r\nSunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit.\r\n\r\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.','Não','','Não','','','','0.2',18,2),(33,'Primeira Consulta','2024-08-03','Posto 2','Cupidatat non proident.\r\nSunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit.\r\n\r\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.','','','','','','','',32,2),(34,'Primeira Consulta','2024-08-03','Posto 2','Cupidatat non proident.\r\nSunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit.\r\n\r\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.','Não','','Não','','Cupidatat non proident.\r\nSunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit.','','14.2',32,2),(36,'Primeira Consulta','2024-07-11','Posto 2','Lorem ipsum dolor sit amet, consectetur adipiscing elit. \r\nUt enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. \r\n\r\nDuis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. \r\nExcepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit.\r\n\r\nIn reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. ','Sim','Vermifugação 1 dose','Não','','Cupidatat non proident.\r\nSunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit.\r\n\r\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.','','6.7',43,2),(38,'Primeira Consulta','2024-08-07','Posto 1','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. \r\nUt enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. \r\n\r\nDuis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. \r\nExcepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit.','Não','','Não','','','','18.9',23,2),(43,'Primeira Consulta','2024-06-29','Posto 1','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. \r\nUt enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. \r\n\r\nDuis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. \r\nExcepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit.\r\n\r\nIn reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. \r\n','Não','','Não','','','','4.8',17,2);
/*!40000 ALTER TABLE `prontuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solici_achados`
--

DROP TABLE IF EXISTS `solici_achados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `solici_achados` (
  `id_solici_achado` int NOT NULL AUTO_INCREMENT,
  `especie` varchar(100) DEFAULT NULL,
  `raca` varchar(100) DEFAULT NULL,
  `pelagem` varchar(100) DEFAULT NULL,
  `sexo` varchar(40) DEFAULT NULL,
  `imagem` varchar(100) DEFAULT NULL,
  `localac` varchar(100) DEFAULT NULL,
  `dataac` date DEFAULT NULL,
  `horaac` time DEFAULT NULL,
  `descritivo` varchar(500) DEFAULT NULL,
  `nome_pessoa` varchar(45) DEFAULT NULL,
  `sobrenome` varchar(45) DEFAULT NULL,
  `telefone1` varchar(20) DEFAULT NULL,
  `telefone2` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_solici_achado`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solici_achados`
--

LOCK TABLES `solici_achados` WRITE;
/*!40000 ALTER TABLE `solici_achados` DISABLE KEYS */;
INSERT INTO `solici_achados` VALUES (3,'cachorro','Pug','Curta, bege e preta','Ni','src/achados-img/pug.jpg','Bela Vista, Rua São carlos','2024-08-09','10:00:00','Andando com dificuldade para respirar.','Bruno','Alvarez','(014) 9000-0000','');
/*!40000 ALTER TABLE `solici_achados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solici_perdidos`
--

DROP TABLE IF EXISTS `solici_perdidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `solici_perdidos` (
  `id_solici_perdido` int NOT NULL AUTO_INCREMENT,
  `rga` varchar(45) DEFAULT NULL,
  `chip` varchar(45) DEFAULT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `datan` date DEFAULT NULL,
  `sexo` varchar(45) DEFAULT NULL,
  `alergias` varchar(45) DEFAULT NULL,
  `doencas` varchar(45) DEFAULT NULL,
  `peso` varchar(45) DEFAULT NULL,
  `especie` varchar(45) DEFAULT NULL,
  `raca` varchar(45) DEFAULT NULL,
  `pelagem` varchar(45) DEFAULT NULL,
  `imagem` varchar(200) DEFAULT NULL,
  `descritivo` varchar(1000) DEFAULT NULL,
  `locald` varchar(1000) DEFAULT NULL,
  `datad` date DEFAULT NULL,
  `horad` time DEFAULT NULL,
  `nome_tutor` varchar(45) DEFAULT NULL,
  `sobrenome` varchar(45) DEFAULT NULL,
  `telefone1` varchar(45) DEFAULT NULL,
  `telefone2` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_solici_perdido`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solici_perdidos`
--

LOCK TABLES `solici_perdidos` WRITE;
/*!40000 ALTER TABLE `solici_perdidos` DISABLE KEYS */;
INSERT INTO `solici_perdidos` VALUES (6,'0.000.000','---','Beck','2018-10-25','Fêmea','Não','Não','14.7','cachorro','Border Collie','Longa, preta com branco','src/perdidos-img/collie.jpg','Fugiu de manhã, ninguém percebeu. Não voltou.','Compos Elíseos','2024-08-14','10:00:00','João','P.','(014) 9 0000-0000','(014) 3653-0000');
/*!40000 ALTER TABLE `solici_perdidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tutores`
--

DROP TABLE IF EXISTS `tutores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tutores` (
  `id_tutor` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(70) NOT NULL,
  `sobrenome` varchar(70) NOT NULL,
  `rg` varchar(12) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `logradouro` varchar(100) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `bairro` varchar(45) DEFAULT NULL,
  `telefone1` varchar(20) NOT NULL,
  `telefone2` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_tutor`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tutores`
--

LOCK TABLES `tutores` WRITE;
/*!40000 ALTER TABLE `tutores` DISABLE KEYS */;
INSERT INTO `tutores` VALUES (1,'Fulano','Fulanos','777777777','88888888888','17380-000','Av. Rodolpho Guimarães','10','Centro','(14) 9 2222-3341',''),(3,'Clara','Carvalho','636363636','25252525252','17380-000','Av. Rodolpho Guimarães','500','Centro','3653-1999','(14) 9 98181-8585'),(4,'João','Barbosa','555555555','77777777777','17380-000','AV. Rui Barbosa','88','Bela Vista','(14) 9 2322-3489',''),(5,'Ana Maria ','Braga','111111111','12121212121','17380-000','Rua Projac','01-B','Patrimonio','(14) 9 9009-8709',''),(6,'Giovana','Balestrero','234234234','12312312312','17380-000','Av. Rodolpho Guimarães','387','Centro','(14) 9 0000-0000',''),(7,'João ','da Silva Santos','290390293','49030930304','17380-000','Rua Quintino Bocaiuva','809','Centro','(14) 9 2522-3034',''),(9,'Elisabeth','Balestrero','943094204','45647354356','17380-000','Av. Mario Pinotti','432','Centro','(14) 9 9090-9090',''),(15,'Julia','Balestrero','','','','','','','(14) 9 9042-3389',''),(16,'Julia','Balestrero','','','','','','','(14) 9 9042-3389',''),(17,'Giovana','Balestrero','','','','','','','(14) 9 8102-4389',''),(18,'Beth','Balestrero','','','','','','','(14) 9 9382-3049',''),(19,'Pedro','Mamoni','','','','','','','(14) 9 9582-3389',''),(20,'Situação de Rua','- sem dono','-','-','17380-000','-','-','-','-',''),(21,'Maria','Carvalho','12.312.312-3','123.123.123-12','17380-000','Av. Mario Pinotti','123','Bela Vista','(014) 9 9800-0000','(014) 3653-0000'),(22,'Larissa','Dias','45.645.645-6','456.546.456-45','17380-000','Avenida Q','09','Lagoa Dourada','(014) 9 0000-0000','(014) 3653-0000'),(23,'Tutor 12','Sobrenome','65.464.564-5','456.456.456-45','17380-000','Av. Mario Pinotti','565','Centro','(014) 9 9000-0000',''),(24,'Tutor 13','Sobrenome','98.098.098-0','890.890.890-89','17380-000','Rua Quintino Bocaiuva','12','Centro','(014) 9 0000-0000',''),(25,'Tutor 14','Sobrenome','90.909.090-9','909.090.909-09','17380-000','Av. Rodolpho Guimarães','01-B','Centro','(014) 9 0000-0000',''),(26,'Tutor 15','Sobrenome','45.645.878-8','878.767.656-34','17380-000','AV. Rui Barbosa','88','Bela Vista','(014) 9 0000-0000',''),(27,'Tutor 16','Sobrenome','00.129.092-0','812.309.843-24','17380-000','Rua A. s B.','455','São João','(014) 9 0000-0000',''),(28,'Tutor 17','Sobrenome','09.584.584-7','647.383.928-37','17380000','Av. Mario Pinotti','432','Centro','(014) 9 0000-0000',''),(29,'Amanda','Silva','','','','','','','(014) 9 9999-9999',''),(30,'Amanda','Silva','','','','','','','(014) 9 9999-9999',''),(31,'Miriam','Soares','','','','','','','(014) 9 0000-0000','');
/*!40000 ALTER TABLE `tutores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `veterinarios`
--

DROP TABLE IF EXISTS `veterinarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `veterinarios` (
  `id_vet` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `crmv` varchar(15) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `email` varchar(60) NOT NULL,
  `senha` varchar(45) NOT NULL,
  PRIMARY KEY (`id_vet`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `veterinarios`
--

LOCK TABLES `veterinarios` WRITE;
/*!40000 ALTER TABLE `veterinarios` DISABLE KEYS */;
INSERT INTO `veterinarios` VALUES (1,'Vet1','XJHD75','Administrador','vet1@mail.com','e10adc3949ba59abbe56e057f20f883e'),(2,'Vet2','6473829T','Administrador','vet2@mail.com','a8698009bce6d1b8c2128eddefc25aad'),(3,'Vet3','534543','Administrador','vet3@mail.comn','a8698009bce6d1b8c2128eddefc25aad'),(4,'Vet4','893404238','Membro','vet4@mail.com','e10adc3949ba59abbe56e057f20f883e'),(5,'Vet5','984032','Membro','vet5@mail.com','e10adc3949ba59abbe56e057f20f883e');
/*!40000 ALTER TABLE `veterinarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-16 14:34:40
