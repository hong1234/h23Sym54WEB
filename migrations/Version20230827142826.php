<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230827142826 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE send_mail_templates');
        $this->addSql('DROP TABLE userori');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB856A684C FOREIGN KEY (parentid) REFERENCES location (id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE send_mail_templates (mail_template_id INT AUTO_INCREMENT NOT NULL, kategorie_id BIGINT DEFAULT NULL, nachricht LONGTEXT CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, titel CHAR(63) CHARACTER SET utf8 DEFAULT \'NULL\' COLLATE `utf8_general_ci`, document_path VARCHAR(255) CHARACTER SET utf8 DEFAULT \'NULL\' COLLATE `utf8_general_ci`, insert_date DATETIME DEFAULT \'current_timestamp()\', PRIMARY KEY(mail_template_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE userori (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB856A684C');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
    }
}
