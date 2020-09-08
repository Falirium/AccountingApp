<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200906124512 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande_produit (commande_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_DF1E9E8782EA2E54 (commande_id), INDEX IDX_DF1E9E87F347EFB (produit_id), PRIMARY KEY(commande_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande_produit ADD CONSTRAINT FK_DF1E9E8782EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_produit ADD CONSTRAINT FK_DF1E9E87F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande ADD vente_id INT DEFAULT NULL, ADD achat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D7DC7170A FOREIGN KEY (vente_id) REFERENCES vente (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DFE95D117 FOREIGN KEY (achat_id) REFERENCES achat (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6EEAA67D7DC7170A ON commande (vente_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6EEAA67DFE95D117 ON commande (achat_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE commande_produit');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D7DC7170A');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DFE95D117');
        $this->addSql('DROP INDEX UNIQ_6EEAA67D7DC7170A ON commande');
        $this->addSql('DROP INDEX UNIQ_6EEAA67DFE95D117 ON commande');
        $this->addSql('ALTER TABLE commande DROP vente_id, DROP achat_id');
    }
}
