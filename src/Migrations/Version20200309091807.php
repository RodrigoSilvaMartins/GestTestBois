<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200309091807 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE t_questions ADD INDEX IDX_1B60D231EC65120 (fkSubChapter)');
        $this->addSql('ALTER TABLE t_questions ADD fkIdUser INT NOT NULL');
        $this->addSql('ALTER TABLE t_questions ADD CONSTRAINT FK_1B60D23B2174208 FOREIGN KEY (fkIdUser) REFERENCES t_user (idUser)');
        $this->addSql('CREATE INDEX IDX_1B60D23B2174208 ON t_questions (fkIdUser)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE t_questions DROP INDEX IDX_1B60D231EC65120, ADD UNIQUE INDEX UNIQ_1B60D231EC65120 (fkSubChapter)');
        $this->addSql('ALTER TABLE t_questions DROP FOREIGN KEY FK_1B60D23B2174208');
        $this->addSql('DROP INDEX IDX_1B60D23B2174208 ON t_questions');
        $this->addSql('ALTER TABLE t_questions DROP fkIdUser');
    }
}
