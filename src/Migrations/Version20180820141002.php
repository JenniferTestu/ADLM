<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180820141002 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE article_fournisseur (article_id INT NOT NULL, fournisseur_id INT NOT NULL, INDEX IDX_AC1DA0557294869C (article_id), INDEX IDX_AC1DA055670C757F (fournisseur_id), PRIMARY KEY(article_id, fournisseur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_article (commande_id INT NOT NULL, article_id INT NOT NULL, INDEX IDX_F4817CC682EA2E54 (commande_id), INDEX IDX_F4817CC67294869C (article_id), PRIMARY KEY(commande_id, article_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_fournisseur ADD CONSTRAINT FK_AC1DA0557294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_fournisseur ADD CONSTRAINT FK_AC1DA055670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_article ADD CONSTRAINT FK_F4817CC682EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_article ADD CONSTRAINT FK_F4817CC67294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article ADD categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_23A0E66BCF5E72D ON article (categorie_id)');
        $this->addSql('ALTER TABLE avis ADD client_id INT DEFAULT NULL, DROP client');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF019EB6921 FOREIGN KEY (client_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_8F91ABF019EB6921 ON avis (client_id)');
        $this->addSql('ALTER TABLE commande ADD client_id INT DEFAULT NULL, ADD lieu_livraison_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D19EB6921 FOREIGN KEY (client_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DF26B4F5 FOREIGN KEY (lieu_livraison_id) REFERENCES adresse (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D19EB6921 ON commande (client_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6EEAA67DF26B4F5 ON commande (lieu_livraison_id)');
        $this->addSql('ALTER TABLE fournisseur ADD adresse_id INT DEFAULT NULL, DROP adresse');
        $this->addSql('ALTER TABLE fournisseur ADD CONSTRAINT FK_369ECA324DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_369ECA324DE7DC5C ON fournisseur (adresse_id)');
        $this->addSql('ALTER TABLE stock_variation ADD article_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE stock_variation ADD CONSTRAINT FK_FA06D5027294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('CREATE INDEX IDX_FA06D5027294869C ON stock_variation (article_id)');
        $this->addSql('ALTER TABLE utilisateur ADD adresse_id INT DEFAULT NULL, DROP adresse');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B34DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B34DE7DC5C ON utilisateur (adresse_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE article_fournisseur');
        $this->addSql('DROP TABLE commande_article');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66BCF5E72D');
        $this->addSql('DROP INDEX IDX_23A0E66BCF5E72D ON article');
        $this->addSql('ALTER TABLE article DROP categorie_id');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF019EB6921');
        $this->addSql('DROP INDEX IDX_8F91ABF019EB6921 ON avis');
        $this->addSql('ALTER TABLE avis ADD client VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP client_id');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D19EB6921');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DF26B4F5');
        $this->addSql('DROP INDEX IDX_6EEAA67D19EB6921 ON commande');
        $this->addSql('DROP INDEX UNIQ_6EEAA67DF26B4F5 ON commande');
        $this->addSql('ALTER TABLE commande DROP client_id, DROP lieu_livraison_id');
        $this->addSql('ALTER TABLE fournisseur DROP FOREIGN KEY FK_369ECA324DE7DC5C');
        $this->addSql('DROP INDEX UNIQ_369ECA324DE7DC5C ON fournisseur');
        $this->addSql('ALTER TABLE fournisseur ADD adresse VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP adresse_id');
        $this->addSql('ALTER TABLE stock_variation DROP FOREIGN KEY FK_FA06D5027294869C');
        $this->addSql('DROP INDEX IDX_FA06D5027294869C ON stock_variation');
        $this->addSql('ALTER TABLE stock_variation DROP article_id');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B34DE7DC5C');
        $this->addSql('DROP INDEX UNIQ_1D1C63B34DE7DC5C ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur ADD adresse VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP adresse_id');
    }
}
