<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241203132600 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles_listes ADD id_liste_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE articles_listes ADD CONSTRAINT FK_1B1ADF09B88FAD4D FOREIGN KEY (id_liste_id) REFERENCES liste (id)');
        $this->addSql('CREATE INDEX IDX_1B1ADF09B88FAD4D ON articles_listes (id_liste_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles_listes DROP FOREIGN KEY FK_1B1ADF09B88FAD4D');
        $this->addSql('DROP INDEX IDX_1B1ADF09B88FAD4D ON articles_listes');
        $this->addSql('ALTER TABLE articles_listes DROP id_liste_id');
    }
}
