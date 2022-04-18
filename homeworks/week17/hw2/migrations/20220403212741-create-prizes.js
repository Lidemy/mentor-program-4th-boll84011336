'use strict';
module.exports = {
  async up(queryInterface, Sequelize) {
    await queryInterface.createTable('Prizes', {
      id: {
        allowNull: false,
        autoIncrement: true,
        primaryKey: true,
        type: Sequelize.INTEGER
      },
      prizeItem: {
        type: Sequelize.STRING
      },
      prizesNumber: {
        type: Sequelize.INTEGER
      },
      prizeName: {
        type: Sequelize.STRING
      },
      prizeDesc: {
        type: Sequelize.STRING
      },
      imageUrl: {
        type: Sequelize.STRING
      },
      prizeAmount: {
        type: Sequelize.INTEGER
      },
      prizeProbability: {
        type: Sequelize.INTEGER
      },
      backstagePrizeOrder: {
        type: Sequelize.INTEGER
      },
      isDelete: {
        type: Sequelize.INTEGER
      },
      createdAt: {
        allowNull: false,
        type: Sequelize.DATE
      },
      updatedAt: {
        allowNull: false,
        type: Sequelize.DATE
      }
    });
  },
  async down(queryInterface, Sequelize) {
    await queryInterface.dropTable('Prizes');
  }
};