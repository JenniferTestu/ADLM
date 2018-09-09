<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180825151725 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE article_panier (id INT AUTO_INCREMENT NOT NULL, article_id INT DEFAULT NULL, prix DOUBLE PRECISION NOT NULL, remise INT DEFAULT NULL, quantite INT NOT NULL, taille VARCHAR(100) DEFAULT NULL, INDEX IDX_4E0B9A727294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_article_panier (commande_id INT NOT NULL, article_panier_id INT NOT NULL, INDEX IDX_8B5095A882EA2E54 (commande_id), INDEX IDX_8B5095A82D48C258 (article_panier_id), PRIMARY KEY(commande_id, article_panier_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_panier ADD CONSTRAINT FK_4E0B9A727294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE commande_article_panier ADD CONSTRAINT FK_8B5095A882EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_article_panier ADD CONSTRAINT FK_8B5095A82D48C258 FOREIGN KEY (article_panier_id) REFERENCES article_panier (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE commande_article');
        $this->addSql('ALTER TABLE article CHANGE remise remise INT NOT NULL, CHANGE supp supp TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commande_article_panier DROP FOREIGN KEY FK_8B5095A82D48C258');
        $this->addSql('CREATE TABLE commande_article (commande_id INT NOT NULL, article_id INT NOT NULL, INDEX IDX_F4817CC682EA2E54 (commande_id), INDEX IDX_F4817CC67294869C (article_id), PRIMARY KEY(commande_id, article_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande_article ADD CONSTRAINT FK_F4817CC67294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_article ADD CONSTRAINT FK_F4817CC682EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE article_panier');
        $this->addSql('DROP TABLE commande_article_panier');
        $this->addSql('ALTER TABLE article CHANGE remise remise INT DEFAULT NULL, CHANGE supp supp TINYINT(1) DEFAULT NULL');
    }
}
