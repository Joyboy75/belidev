<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220323101932 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client CHANGE raison_sociale raisonsociale VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE demande ADD ged_id INT DEFAULT NULL, DROP ged');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A5D8A51A0A FOREIGN KEY (ged_id) REFERENCES ged (id)');
        $this->addSql('CREATE INDEX IDX_2694D7A5D8A51A0A ON demande (ged_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client ADD raison_sociale VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP raisonsociale, CHANGE adresse adresse VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ville ville VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE contact CHANGE nom nom VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE prenom prenom VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE telephone telephone VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE email email VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE qualite qualite VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY FK_2694D7A5D8A51A0A');
        $this->addSql('DROP INDEX IDX_2694D7A5D8A51A0A ON demande');
        $this->addSql('ALTER TABLE demande ADD ged VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP ged_id, CHANGE statut statut VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE offre offre VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE information_client information_client VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE ged CHANGE nom nom VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE type type VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE offre CHANGE titre titre VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE liste_avantages liste_avantages LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
