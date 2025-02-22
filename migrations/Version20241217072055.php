<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241217072055 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles_listes DROP FOREIGN KEY FK_1B1ADF09B88FAD4D');
        $this->addSql('ALTER TABLE articles_listes_produit DROP FOREIGN KEY FK_AA54E2B3F347EFB');
        $this->addSql('ALTER TABLE articles_listes_produit DROP FOREIGN KEY FK_AA54E2B39252DE0E');
        $this->addSql('ALTER TABLE liste_produit DROP FOREIGN KEY FK_989F7476E85441D8');
        $this->addSql('ALTER TABLE liste_produit DROP FOREIGN KEY FK_989F7476F347EFB');
        $this->addSql('DROP TABLE articles_listes');
        $this->addSql('DROP TABLE articles_listes_produit');
        $this->addSql('DROP TABLE liste_produit');
        $this->addSql('DROP TABLE liste');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE articles_listes (id INT AUTO_INCREMENT NOT NULL, id_liste_id INT DEFAULT NULL, quantite DOUBLE PRECISION NOT NULL, is_in_list TINYINT(1) NOT NULL, INDEX IDX_1B1ADF09B88FAD4D (id_liste_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE articles_listes_produit (articles_listes_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_AA54E2B3F347EFB (produit_id), INDEX IDX_AA54E2B39252DE0E (articles_listes_id), PRIMARY KEY(articles_listes_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE liste_produit (liste_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_989F7476E85441D8 (liste_id), INDEX IDX_989F7476F347EFB (produit_id), PRIMARY KEY(liste_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE liste (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, notes VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE articles_listes ADD CONSTRAINT FK_1B1ADF09B88FAD4D FOREIGN KEY (id_liste_id) REFERENCES liste (id)');
        $this->addSql('ALTER TABLE articles_listes_produit ADD CONSTRAINT FK_AA54E2B3F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE articles_listes_produit ADD CONSTRAINT FK_AA54E2B39252DE0E FOREIGN KEY (articles_listes_id) REFERENCES articles_listes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE liste_produit ADD CONSTRAINT FK_989F7476E85441D8 FOREIGN KEY (liste_id) REFERENCES liste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE liste_produit ADD CONSTRAINT FK_989F7476F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
    }
}
