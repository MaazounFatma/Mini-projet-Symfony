<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200430154750 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE etape_circuit ADD code_ville_id INT NOT NULL');
        $this->addSql('ALTER TABLE etape_circuit ADD CONSTRAINT FK_484C507D5EBE781D FOREIGN KEY (code_ville_id) REFERENCES ville (id)');
        $this->addSql('CREATE INDEX IDX_484C507D5EBE781D ON etape_circuit (code_ville_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE etape_circuit DROP FOREIGN KEY FK_484C507D5EBE781D');
        $this->addSql('DROP INDEX IDX_484C507D5EBE781D ON etape_circuit');
        $this->addSql('ALTER TABLE etape_circuit DROP code_ville_id');
    }
}
