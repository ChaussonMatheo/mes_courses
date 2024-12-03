<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241203130234 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE articles_listes (id INT AUTO_INCREMENT NOT NULL, quantite DOUBLE PRECISION NOT NULL, is_in_list TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE articles_listes_produit (articles_listes_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_AA54E2B39252DE0E (articles_listes_id), INDEX IDX_AA54E2B3F347EFB (produit_id), PRIMARY KEY(articles_listes_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE liste (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, notes VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE articles_listes_produit ADD CONSTRAINT FK_AA54E2B39252DE0E FOREIGN KEY (articles_listes_id) REFERENCES articles_listes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE articles_listes_produit ADD CONSTRAINT FK_AA54E2B3F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC279F2C3FAB FOREIGN KEY (zone_id) REFERENCES zone (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles_listes_produit DROP FOREIGN KEY FK_AA54E2B39252DE0E');
        $this->addSql('ALTER TABLE articles_listes_produit DROP FOREIGN KEY FK_AA54E2B3F347EFB');
        $this->addSql('DROP TABLE articles_listes');
        $this->addSql('DROP TABLE articles_listes_produit');
        $this->addSql('DROP TABLE liste');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC279F2C3FAB');
    }
}
