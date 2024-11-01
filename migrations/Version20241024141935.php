<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241024141935 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE song ADD name_id INT NOT NULL');
        $this->addSql('ALTER TABLE song ADD CONSTRAINT FK_33EDEEA171179CD6 FOREIGN KEY (name_id) REFERENCES singer (id)');
        $this->addSql('CREATE INDEX IDX_33EDEEA171179CD6 ON song (name_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE song DROP FOREIGN KEY FK_33EDEEA171179CD6');
        $this->addSql('DROP INDEX IDX_33EDEEA171179CD6 ON song');
        $this->addSql('ALTER TABLE song DROP name_id');
    }
}
