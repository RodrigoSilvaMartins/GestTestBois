<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200131122424 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE t_subChapters (idSubChapter INT AUTO_INCREMENT NOT NULL, subName VARCHAR(255) NOT NULL, subNumber INT NOT NULL, fkChapter INT NOT NULL, fkLevel INT DEFAULT NULL, INDEX IDX_6596B8AFEFA103A1 (fkChapter), INDEX IDX_6596B8AF8A304D32 (fkLevel), PRIMARY KEY(idSubChapter)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE t_subjects (idSubject INT AUTO_INCREMENT NOT NULL, subName VARCHAR(255) NOT NULL, PRIMARY KEY(idSubject)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE t_levels (idLevel INT AUTO_INCREMENT NOT NULL, levName VARCHAR(255) NOT NULL, PRIMARY KEY(idLevel)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE t_image (idImage INT AUTO_INCREMENT NOT NULL, imaName VARCHAR(255) NOT NULL, imaContent LONGBLOB NOT NULL, imaFormat VARCHAR(255) NOT NULL, PRIMARY KEY(idImage)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE t_examQuestions (idExamQuestion INT AUTO_INCREMENT NOT NULL, exaOrder INT NOT NULL, fkExam INT NOT NULL, fkQuestion INT NOT NULL, INDEX IDX_409159E43840DD5C (fkExam), INDEX IDX_409159E4CBE6F749 (fkQuestion), PRIMARY KEY(idExamQuestion)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE t_themes (idTheme INT AUTO_INCREMENT NOT NULL, theName VARCHAR(255) NOT NULL, fkSubject INT NOT NULL, INDEX IDX_3C254A20EDEE88F5 (fkSubject), PRIMARY KEY(idTheme)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE t_exams (idExam INT AUTO_INCREMENT NOT NULL, exaName VARCHAR(255) NOT NULL, exaCreationDate DATETIME DEFAULT NULL, duration INT NOT NULL, fkSubject INT NOT NULL, INDEX IDX_D7807551EDEE88F5 (fkSubject), PRIMARY KEY(idExam)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE t_chapters (idChapter INT AUTO_INCREMENT NOT NULL, chaName VARCHAR(255) NOT NULL, chaNumber INT NOT NULL, fkTheme INT NOT NULL, INDEX IDX_13C05F2B87AF6629 (fkTheme), PRIMARY KEY(idChapter)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE t_questions (idQuestion INT AUTO_INCREMENT NOT NULL, queQuestion VARCHAR(255) NOT NULL, queAnswer VARCHAR(255) NOT NULL, quePoints INT NOT NULL, queFormula LONGTEXT DEFAULT NULL, fkSubChapter INT DEFAULT NULL, fkImage INT DEFAULT NULL, INDEX IDX_1B60D23D5E7857E (fkImage), PRIMARY KEY(idQuestion)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE t_subChapters ADD CONSTRAINT FK_6596B8AFEFA103A1 FOREIGN KEY (fkChapter) REFERENCES t_chapters (idChapter)');
        $this->addSql('ALTER TABLE t_subChapters ADD CONSTRAINT FK_6596B8AF8A304D32 FOREIGN KEY (fkLevel) REFERENCES t_levels (idLevel)');
        $this->addSql('ALTER TABLE t_examQuestions ADD CONSTRAINT FK_409159E43840DD5C FOREIGN KEY (fkExam) REFERENCES t_exams (idExam)');
        $this->addSql('ALTER TABLE t_examQuestions ADD CONSTRAINT FK_409159E4CBE6F749 FOREIGN KEY (fkQuestion) REFERENCES t_questions (idQuestion)');
        $this->addSql('ALTER TABLE t_themes ADD CONSTRAINT FK_3C254A20EDEE88F5 FOREIGN KEY (fkSubject) REFERENCES t_subjects (idSubject)');
        $this->addSql('ALTER TABLE t_exams ADD CONSTRAINT FK_D7807551EDEE88F5 FOREIGN KEY (fkSubject) REFERENCES t_subjects (idSubject)');
        $this->addSql('ALTER TABLE t_chapters ADD CONSTRAINT FK_13C05F2B87AF6629 FOREIGN KEY (fkTheme) REFERENCES t_themes (idTheme)');
        $this->addSql('ALTER TABLE t_questions ADD CONSTRAINT FK_1B60D23D5E7857E FOREIGN KEY (fkImage) REFERENCES t_image (idImage)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE t_themes DROP FOREIGN KEY FK_3C254A20EDEE88F5');
        $this->addSql('ALTER TABLE t_exams DROP FOREIGN KEY FK_D7807551EDEE88F5');
        $this->addSql('ALTER TABLE t_subChapters DROP FOREIGN KEY FK_6596B8AF8A304D32');
        $this->addSql('ALTER TABLE t_questions DROP FOREIGN KEY FK_1B60D23D5E7857E');
        $this->addSql('ALTER TABLE t_chapters DROP FOREIGN KEY FK_13C05F2B87AF6629');
        $this->addSql('ALTER TABLE t_examQuestions DROP FOREIGN KEY FK_409159E43840DD5C');
        $this->addSql('ALTER TABLE t_subChapters DROP FOREIGN KEY FK_6596B8AFEFA103A1');
        $this->addSql('ALTER TABLE t_examQuestions DROP FOREIGN KEY FK_409159E4CBE6F749');
        $this->addSql('DROP TABLE t_subChapters');
        $this->addSql('DROP TABLE t_subjects');
        $this->addSql('DROP TABLE t_levels');
        $this->addSql('DROP TABLE t_image');
        $this->addSql('DROP TABLE t_examQuestions');
        $this->addSql('DROP TABLE t_themes');
        $this->addSql('DROP TABLE t_exams');
        $this->addSql('DROP TABLE t_chapters');
        $this->addSql('DROP TABLE t_questions');
    }
}
