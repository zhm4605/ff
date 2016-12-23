import React from 'react';
//import ReactDOM from 'react-dom';

var yinshe = {
  familyId: '户编码',
  huzhu: '户主',
  enjoyNum: '享受人数',
  totalMoney:'总救助金额',
  editable: '操作'
};
export default class List extends React.Component{
  constructor() {
    super();
  }
  show_ziduan(key,value)
  {
    if(key=='editable')
    {
      if(value==1)
      {
        return (
          <div className="buttons-wrap">
            <button>编辑</button>
            <button>驳回</button>
          </div>
        )
      }
      else
      {
        return (
          <button>查看</button>
        )
      }
    }
    else
    {
      return value;
    }
  }
  render() {
    return (
      <table>
        <tr>
          {this.props.config.map(ziduan=>{
            return (
              <td>{yinshe[ziduan]}</td>
            )
          })}
        </tr>
        {this.props.list.map(item=>{
          return (
            <tr>
              {this.props.config.map(key=>{
                return (
                  <td>{this.show_ziduan(key,item[key])}</td>
                )
              })}
            </tr>
          )
        })}
      </table>
    )
  }
};



