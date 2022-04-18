'use strict';
const {
  Model
} = require('sequelize');
module.exports = (sequelize, DataTypes) => {
  class Prizes extends Model {
    /**
     * Helper method for defining associations.
     * This method is not a part of Sequelize lifecycle.
     * The `models/index` file will call this method automatically.
     */
    static associate(models) {
      // define association here
    }
  }
  Prizes.init({
    prizeItem: DataTypes.STRING,
    prizesNumber: DataTypes.INTEGER,
    prizeName: DataTypes.STRING,
    prizeDesc: DataTypes.STRING,
    imageUrl: DataTypes.STRING,
    prizeAmount: DataTypes.INTEGER,
    prizeProbability: DataTypes.INTEGER,
    backstagePrizeOrder: DataTypes.INTEGER,
    isDelete: DataTypes.INTEGER
  }, {
    sequelize,
    modelName: 'Prizes',
  });
  return Prizes;
};