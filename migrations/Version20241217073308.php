<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241217073308 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ligne (id INT AUTO_INCREMENT NOT NULL, produit_id INT DEFAULT NULL, liste_id INT DEFAULT NULL, dans_le_caddy TINYINT(1) NOT NULL, INDEX IDX_57F0DB83F347EFB (produit_id), INDEX IDX_57F0DB83E85441D8 (liste_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ligne ADD CONSTRAINT FK_57F0DB83F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE ligne ADD CONSTRAINT FK_57F0DB83E85441D8 FOREIGN KEY (liste_id) REFERENCES liste (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ligne DROP FOREIGN KEY FK_57F0DB83F347EFB');
        $this->addSql('ALTER TABLE ligne DROP FOREIGN KEY FK_57F0DB83E85441D8');
        $this->addSql('DROP TABLE ligne');
    }
}
