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
  `id_animal` int DEFAULT NULL,
  `imagem` varchar(100) DEFAULT NULL,
  `localac` varchar(100) DEFAULT NULL,
  `dataac` date DEFAULT NULL,
  `horaac` time DEFAULT NULL,
  `descritivo` varchar(500) DEFAULT NULL,
  `nome_pessoa` varchar(45) DEFAULT NULL,
  `sobrenome` varchar(45) DEFAULT NULL,
  `telefone1` varchar(20) DEFAULT NULL,
  `telefone2` varchar(20) DEFAULT NULL,
  `statusac` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_achado`),
  KEY `fka_id_animal` (`id_animal`),
  CONSTRAINT `fka_id_animal` FOREIGN KEY (`id_animal`) REFERENCES `animais` (`id_animal`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `achados`
--

LOCK TABLES `achados` WRITE;
/*!40000 ALTER TABLE `achados` DISABLE KEYS */;
INSERT INTO `achados` VALUES (1,37,'src/achados-img/pinscher.jpg','Av. Rodolpho Guimaraes, Praça Amador Simões','2024-07-26','09:29:00','Encontrado na manhã de sexta, utilizando coleira vermelha sem identificador.','Giovana','Balestrero','(14) 9 2842-3349','','Achado'),(2,38,'src/achados-img/calico.jpg','Marginal','2024-07-12','19:52:00','Encontrei enquanto caminhava. Gata dócil. Quase foi atropelada por um ciclista.  Está com uma coleira rosa sem identificação.','Pedro','Mamoni','(14) 9 4542-3379','','Achado');
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
  PRIMARY KEY (`id_animal`),
  KEY `fk_id_tutor` (`id_tutor`),
  CONSTRAINT `fk_id_tutor` FOREIGN KEY (`id_tutor`) REFERENCES `tutores` (`id_tutor`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `animais`
--

LOCK TABLES `animais` WRITE;
/*!40000 ALTER TABLE `animais` DISABLE KEYS */;
INSERT INTO `animais` VALUES (15,'47987948','HJD88PP','Gatito','2022-07-08','Fêmea','Não','Não','Não','7','Felino','Laranja','Curta','Adotado',1),(16,'97069705','h86h5fv42f','Cachorrito','2016-10-12','Macho','Não','Diabetes','Castração','20','Canino','SRD','Curta','Adotado',1),(17,'46839423','JSUP94374j','Fuleco','2014-02-18','Macho','Não','Não','Não','8','Tatu','Bola','blindada','roubado',1),(18,'8439900','93jdh838jn','Louro José','1997-03-28','Macho','Não','Não','Não','0.4','Ave','Papagaio','...','Inventado',5),(19,'9320390','4354g533gd','Belinha','2002-06-09','Fêmea','Não','Não','Castração','5.7','Canino','Puldo','Enrolada','Comprado',1),(20,'15245234','67rg46rd','Panda','2020-08-15','Fêmea','Não','Não','Castração','4.8','Felino','Siamês','Curta','Resgatado',6),(21,'212121212','03940333ff3','Kim','2018-09-08','Macho','Não','Não','Castração','6.4','Felino','Bombaim','Curta','Adotado',6),(22,'0039002','jsdf6327','Puma','2024-03-01','Macho','Não','Não','Não','3.4','Felino','Bombaim','Longa','Adotado',7),(23,'090003','749823','Tobias','2015-09-26','Macho','Não','Não','Castração','18.7','Canino','SRD','Curta','Adotado',4),(29,'','','Chico','2024-02-09','Macho','Não','','Não','6','cachorro','Pinscher','Curta e preta','Adotado',16),(30,'','','Belinha','2013-04-27','Fêmea','','','Castração','6','cachorro','Poodle','branca e enrolada','Comprado',17),(31,'','','Pompom','2015-10-20','Fêmea','','','','6','cachorro','Poodle','branca e enrolada','Comprado',18),(32,'','','Totó','2024-07-10','Macho','','','','8','cachorro','SRD','marrom e branca, curta','Adotado',19),(33,'','','',NULL,'Macho','','','','','cachorro','pinscher','Curta e preta','',NULL),(34,'','','',NULL,'Macho','','','','','cachorro','pinscher','Curta e preta','',NULL),(35,'','','',NULL,'Macho','','','','','cachorro','pinscher','Curta e preta','',NULL),(36,'','','',NULL,'Macho','','','','','cachorro','pinscher','Curta e preta','',NULL),(37,'','','',NULL,'Macho','','','','','cachorro','pinscher','Curta e preta','',NULL),(38,'','','',NULL,'Fêmea','','','','','gato','SRD/Calico','Longa -  laranja, preto e branco','',NULL);
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
  `id_animal` int NOT NULL,
  `imagem` varchar(200) DEFAULT NULL,
  `descritivo` varchar(1000) DEFAULT NULL,
  `locald` varchar(1000) DEFAULT NULL,
  `datad` date DEFAULT NULL,
  `horad` time DEFAULT NULL,
  `id_tutor` int NOT NULL,
  `statusd` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_perdido`),
  KEY `fkp_id_tutor` (`id_tutor`),
  KEY `fkp_id_animal` (`id_animal`),
  CONSTRAINT `fkp_id_animal` FOREIGN KEY (`id_animal`) REFERENCES `animais` (`id_animal`),
  CONSTRAINT `fkp_id_tutor` FOREIGN KEY (`id_tutor`) REFERENCES `tutores` (`id_tutor`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perdidos`
--

LOCK TABLES `perdidos` WRITE;
/*!40000 ALTER TABLE `perdidos` DISABLE KEYS */;
INSERT INTO `perdidos` VALUES (1,29,'src/perdidos-img/pinscher.jpg','Minha casa tem muro baixo, acho que alguém o pegou','Av Rui Barbosa','2024-06-23','15:00:00',16,'Perdido'),(3,31,'src/perdidos-img/puldo.jpg','Estava passeando, quando a guia rompeu e ela correu atrás de uma moto','Rua Professor Emílio Reimão','2024-06-10','10:47:00',18,'Perdido'),(4,32,'src/perdidos-img/cachorro.jpg','Escapou pelo portão e desapareceu na avenida','Av Rui Barbosa','2024-07-19','19:09:00',19,'Perdido');
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
  `arquivo` varchar(300) NOT NULL,
  `peso` varchar(45) DEFAULT NULL,
  `id_animal` int NOT NULL,
  `id_vet` int NOT NULL,
  PRIMARY KEY (`id_pront`),
  KEY `fk_id_animal` (`id_animal`),
  KEY `fk_id_vet` (`id_vet`),
  CONSTRAINT `fk_id_animal` FOREIGN KEY (`id_animal`) REFERENCES `animais` (`id_animal`),
  CONSTRAINT `fk_id_vet` FOREIGN KEY (`id_vet`) REFERENCES `veterinarios` (`id_vet`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prontuarios`
--

LOCK TABLES `prontuarios` WRITE;
/*!40000 ALTER TABLE `prontuarios` DISABLE KEYS */;
INSERT INTO `prontuarios` VALUES (6,'Primeira Consulta','2024-07-17','Posto 1','vacinas em ordem\r\n**Temperatura Corporal:** [Temperatura Corporal]\r\n**Frequência Respiratória:** [Frequência Respiratória]\r\n\r\n**Medicação:** [Medicação Prescrita]\r\n**Dosagem:** [Dosagem da Medicação]\r\n**Duração:** [Duração do Tratamento]\r\n**Outras Recomendações:** [Outras Recomendações]',NULL,NULL,NULL,NULL,NULL,'',NULL,15,1),(8,'Lesão pata','2024-07-19','Posto 2','## Motivo da Consulta\r\n- **Descrição:** [Descrição do Motivo da Consulta]\r\n\r\n## Exame Físico\r\n- **Temperatura Corporal:** [Temperatura Corporal]\r\n- **Frequência Cardíaca:** [Frequência Cardíaca]\r\n- **Frequência Respiratória:** [Frequência Respiratória]\r\n- **Estado Geral:** [Estado Geral do Animal]\r\n- **Sistema Respiratório:** [Avaliação do Sistema Respiratório]\r\n\r\n## Exames Complementares\r\n- **Exames Solicitados:** [Lista de Exames Solicitados]\r\n- **Resultados dos Exames:** [Resultados dos Exames]\r\n\r\n## Diagnóstico Definitivo\r\n- **Diagnóstico:** [Diagnóstico Definitivo]\r\n\r\n## Plano Terapêutico\r\n- **Medicação:** [Medicação Prescrita]\r\n- **Dosagem:** [Dosagem da Medicação]\r\n- **Duração:** [Duração do Tratamento]\r\n- **Outras Recomendações:** [Outras Recomendações]\r\n\r\n## Procedimentos Realizados\r\n- **Procedimento:** [Descrição do Procedimento Realizado]\r\n- **Data:** [Data do Procedimento]\r\n\r\n### Notas Finais\r\nEste prontuário deve ser mantido atualizado em cada consulta e revisão do paciente. Todos os dados devem ser inseridos de maneira precisa e detalhada para garantir o melhor atendimento ao animal.\r\n\r\n',NULL,NULL,NULL,NULL,NULL,'gato.jpg',NULL,20,2),(9,'Dor e febre','2024-07-11','Posto 4','## Plano Terapêutico\r - **Medicação:** [Medicação Prescrita]',NULL,NULL,NULL,NULL,NULL,'cachorro.jpg',NULL,19,5),(12,'Nao responsivo','2014-06-11','Posto 1','## Motivo da Consulta\r\n- **Descrição:** [Descrição do Motivo da Consulta]\r\n\r\n## Exame Físico\r\n- **Temperatura Corporal:** [Temperatura Corporal]\r\n- **Frequência Cardíaca:** [Frequência Cardíaca]\r\n- **Frequência Respiratória:** [Frequência Respiratória]\r\n- **Estado Geral:** [Estado Geral do Animal]\r\n- **Mucosas:** [Descrição das Mucosas]\r\n- **Pele e Pelagem:** [Condição da Pele e Pelagem]\r\n- **Linfonodos:** [Avaliação dos Linfonodos]\r\n- **Sistema Respiratório:** [Avaliação do Sistema Respiratório]\r\n- **Sistema Cardiovascular:** [Avaliação do Sistema Cardiovascular]\r\n- **Sistema Digestório:** [Avaliação do Sistema Digestório]\r\n- **Sistema Urinário:** [Avaliação do Sistema Urinário]\r\n- **Sistema Musculoesquelético:** [Avaliação do Sistema Musculoesquelético]\r\n- **Sistema Nervoso:** [Avaliação do Sistema Nervoso]\r\n\r\n## Diagnóstico Presuntivo\r\n- **Diagnóstico:** [Diagnóstico Presuntivo]\r\n\r\n## Exames Complementares\r\n- **Exames Solicitados:** [Lista de Exames Solicitados]\r\n- **Resultados dos Exames:** [Resultados dos Exames]\r\n\r\n## Diagnóstico Definitivo\r\n- **Diagnóstico:** [Diagnóstico Definitivo]\r\n\r\n## Plano Terapêutico\r\n- **Medicação:** [Medicação Prescrita]\r\n- **Dosagem:** [Dosagem da Medicação]\r\n- **Duração:** [Duração do Tratamento]\r\n- **Outras Recomendações:** [Outras Recomendações]\r\n',NULL,NULL,NULL,NULL,NULL,'fuleco.png',NULL,17,5),(13,'Primeira Consulta','2023-03-17','Posto 2','## Motivo da Consulta\r\n- **Descrição:** [Descrição do Motivo da Consulta]\r\n\r\n## Exame Físico\r\n- **Temperatura Corporal:** [Temperatura Corporal]\r\n- **Frequência Cardíaca:** [Frequência Cardíaca]\r\n- **Frequência Respiratória:** [Frequência Respiratória]\r\n- **Estado Geral:** [Estado Geral do Animal]\r\n- **Mucosas:** [Descrição das Mucosas]\r\n- **Pele e Pelagem:** [Condição da Pele e Pelagem]\r\n- **Linfonodos:** [Avaliação dos Linfonodos]\r\n- **Sistema Respiratório:** [Avaliação do Sistema Respiratório]\r\n- **Sistema Cardiovascular:** [Avaliação do Sistema Cardiovascular]\r\n- **Sistema Digestório:** [Avaliação do Sistema Digestório]\r\n- **Sistema Urinário:** [Avaliação do Sistema Urinário]\r\n- **Sistema Musculoesquelético:** [Avaliação do Sistema Musculoesquelético]\r\n- **Sistema Nervoso:** [Avaliação do Sistema Nervoso]\r\n\r\n## Diagnóstico Presuntivo\r\n- **Diagnóstico:** [Diagnóstico Presuntivo]\r\n\r\n## Exames Complementares\r\n- **Exames Solicitados:** [Lista de Exames Solicitados]\r\n- **Resultados dos Exames:** [Resultados dos Exames]\r\n\r\n## Diagnóstico Definitivo\r\n- **Diagnóstico:** [Diagnóstico Definitivo]\r\n\r\n## Plano Terapêutico\r\n- **Medicação:** [Medicação Prescrita]\r\n- **Dosagem:** [Dosagem da Medicação]\r\n- **Duração:** [Duração do Tratamento]\r\n- **Outras Recomendações:** [Outras Recomendações]\r\n',NULL,NULL,NULL,NULL,NULL,'Ficha do animal de estimação.pdf',NULL,18,5),(16,'Primeira Consulta','2024-07-11','Posto 1','Vermifugação\r\n\r\nExame Físico\r\nTemperatura: 38.5°C\r\nFrequência Cardíaca: 90 bpm\r\nFrequência Respiratória: 20 rpm\r\nMucosas: Normais\r\nHidratação: Adequada\r\n\r\nDiagnóstico\r\nDiagnóstico Principal: Saúde geral boa\r\nDiagnósticos Secundários: Nenhum\r\n\r\nTratamento Prescrito\r\nMedicação: Vermífugo (Milbemax) - 1 comprimido\r\n\r\nRecomendações: Continuar alimentação balanceada, exercício regular, próximo check-up em um ano',NULL,NULL,NULL,NULL,NULL,'gato.png',NULL,22,3),(17,'Segunda consulta','2024-07-29','Posto 2','teste update peso\r\npeso antigo 6kg\r\nnovo peso 7kg',NULL,NULL,NULL,NULL,NULL,'','7',15,1);
/*!40000 ALTER TABLE `prontuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `atualizar_peso_animal` AFTER INSERT ON `prontuarios` FOR EACH ROW BEGIN
    UPDATE animais
    SET peso = NEW.peso
    WHERE id_animal = NEW.id_animal;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tutores`
--

LOCK TABLES `tutores` WRITE;
/*!40000 ALTER TABLE `tutores` DISABLE KEYS */;
INSERT INTO `tutores` VALUES (1,'Fulano','Fulanos','777777777','88888888888','17380-000','Av. Rodolpho Guimarães','10','Centro','(14) 9 2222-3341',''),(3,'Clara','Carvalho','636363636','25252525252','17380-000','Av. Rodolpho Guimarães','500','Centro','3653-1999','(14) 9 98181-8585'),(4,'João','Barbosa','555555555','77777777777','17380-000','AV. Rui Barbosa','88','Bela Vista','(14) 9 2322-3489',''),(5,'Ana Maria ','Braga','111111111','12121212121','17380-000','Rua Projac','01-B','Patrimonio','(14) 9 9009-8709',''),(6,'Giovana','Balestrero','234234234','12312312312','17380-000','Av. Rodolpho Guimarães','387','Centro','(14) 9 0000-0000',''),(7,'João ','da Silva Santos','290390293','49030930304','17380-000','Rua Quintino Bocaiuva','809','Centro','(14) 9 2522-3034',''),(9,'Elisabeth','Balestrero','943094204','45647354356','17380-000','Av. Mario Pinotti','432','Centro','(14) 9 9090-9090',''),(10,'Bruna ','Balestrero','245453243','65745674534','17380-000','Rua Quintino Bocaiuva','124','Centro','(14) 9 9822-3344',''),(15,'Julia','Balestrero','','','','','','','(14) 9 9042-3389',''),(16,'Julia','Balestrero','','','','','','','(14) 9 9042-3389',''),(17,'Giovana','Balestrero','','','','','','','(14) 9 8102-4389',''),(18,'Beth','Balestrero','','','','','','','(14) 9 9382-3049',''),(19,'Pedro','Mamoni','','','','','','','(14) 9 9582-3389',''),(20,'Situação de Rua','- sem dono','-','-','17380-000','-','-','-','-','');
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

--
-- Dumping events for database 'sistema-vet'
--

--
-- Dumping routines for database 'sistema-vet'
--
/*!50003 DROP PROCEDURE IF EXISTS `BuscarProntuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `BuscarProntuario`(IN id_pront INT)
BEGIN
    SELECT 
        prontuarios.*,
        DATE_FORMAT(prontuarios.dataa, '%d/%m/%Y') AS dataa_formatada,
        animais.nome AS nome_animal,
        animais.rga,
        animais.chip,
        DATE_FORMAT(animais.datan, '%d/%m/%Y') AS datan_formatada,
        animais.sexo,
        animais.peso AS peso_animal,
        animais.alergias,
        animais.doencas,
        animais.cirurgias,
        animais.peso,
        animais.especie,
        animais.raca,
        animais.pelagem,
        animais.aquisicao,
        tutores.nome AS nome_tutor,
        tutores.sobrenome,
        veterinarios.nome AS nome_vet
    FROM 
        prontuarios
    JOIN 
        animais ON prontuarios.id_animal = animais.id_animal
    JOIN 
        tutores ON animais.id_tutor = tutores.id_tutor
    JOIN 
        veterinarios ON prontuarios.id_vet = veterinarios.id_vet
    WHERE 
        prontuarios.id_pront = id_pront;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-07-29 15:58:11
