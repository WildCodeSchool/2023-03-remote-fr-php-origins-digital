<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230608115839 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE video ADD private TINYINT(1) NOT NULL, ADD upcoming TINYINT(1) NOT NULL, DROP is_private, DROP is_upcoming');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE video ADD is_private TINYINT(1) NOT NULL, ADD is_upcoming TINYINT(1) NOT NULL, DROP private, DROP upcoming');
    }
}
